package help.me.orm.bo.impl;

import java.util.Calendar;
import java.util.Collection;
import java.util.Collections;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.hibernate.Criteria;
import org.hibernate.search.FullTextQuery;
import org.hibernate.search.FullTextSession;
import org.hibernate.search.Search;
import org.hibernate.search.annotations.Spatial;
import org.hibernate.search.query.dsl.QueryBuilder;
import org.hibernate.search.query.dsl.Unit;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.IUserBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.IServiceDao;
import help.me.orm.dao.impl.UserDaoImpl;
import help.me.orm.entity.License;
import help.me.orm.entity.Location;
import help.me.orm.entity.Service;
import help.me.orm.entity.User;

/**
 * @author triviski
 *
 */
@Repository("userBo")
public class UserBoImpl implements IUserBo {
	private static final int MAX_RESULTS = 30;
	/**
	 * Used to get the current query time and subtract to filter locations.
	 */
	private static final int MAX_LOCATION_AGE_MINUTES = 1000 * 60 * 60;
	
	

	@Autowired
	UserDaoImpl userDao;
	
	@Autowired
	LicenseBoImpl licenseBo;
	
	@Autowired
	LocationBoImpl locationBo;
	
//	@Autowired
//	ServiceBoImpl serviceBo;
	
	@Autowired
	IServiceDao serviceBo;
	
	/* (non-Javadoc)
	 * @see help.me.orm.bo.IUserBo#findByEmail(java.lang.String)
	 */
	@Override
	public User findByEmail(String email) {
		return userDao.findByEmail(email);
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IBo#getDao()
	 */
	@Override
	public IDao<User> getDao() {
		return userDao;
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IUserBo#findByEmailOrCreate(java.lang.String)
	 */
	@Override
	public User findByEmailOrCreate(String email) {
		User user = findByEmail(email);
		
		return user == null ? new User() : user;
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IUserBo#getLastLocation(help.me.orm.entity.User)
	 */
	@Override
	public Location getLastLocation(User user) {
		return locationBo.getLastLocation(user);
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IUserBo#getLastLocation(java.lang.String)
	 */
	@Override
	public Location getLastLocation(String email) {
		return locationBo.getLastLocation(email);
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IUserBo#addLocation(help.me.orm.entity.User, double, double)
	 */
	@Override
	public Location addLocation(User user, double longitude, double latitude) {
		return locationBo.addLocation(user, longitude, latitude);
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IUserBo#addLocation(java.lang.String, double, double)
	 */
	@Override
	public Location addLocation(String email, double longitude, double latitude) {
		return locationBo.addLocation(email, longitude, latitude);
	}

	/**
	 * @param user
	 * @param licenseId
	 * @param serviceDescription
	 * 
	 * @return newly added license
	 */
	@Override
	public License addLicense(User user, String licenseNum, String serviceDescription) {
		License license = licenseBo.createNewLicense(licenseNum, user, serviceDescription);
		user.addLicense(license);
		
		return license;
	}

	/**
	 * Uses the Haversine Formula to calculate the distance between the two sets of coordinates.
	 * dlat = lat2 - lat1 
	 * a = (sin(dlat/2))^2 + cos(lat1) * cos(lat2) * (sin(dlon/2))^2 
	 * c = 2 * atan2( sqrt(a), sqrt(1-a) ) 
	 * d = R * c (where R is the radius of the Earth)
	 * 
	 * @param longitude1
	 * @param latitude1
	 * @param longitude2
	 * @param latitude2
	 * @return
	 */
	protected double calculateDistance(double longitude1, double latitude1, double longitude2, double latitude2) {
		return 1;
	}
	
	/**
	 * Gets the users last location, calculates the distances from the given coordinates and does a distance check.
	 * 
	 * @param user
	 * @param longitude
	 * @param latitude
	 * @param distance
	 * @return
	 */
	protected boolean withinDistnace(User user, double longitude, double latitude, double distance) {
		Location loc = getLastLocation(user);
		
		return loc != null && calculateDistance(longitude, latitude, loc.getLongitude(), loc.getLatitude()) <= distance;
	}
	
	private double milesToKM(double distanceInMiles) {
	      return distanceInMiles * 1.609344;
	}

	private double KMToMiles(double distanceInKM) {
	      return distanceInKM / 1.609344;
	}

	/* (non-Javadoc)
	 * @see help.me.orm.dao.ILicenseDao#findProviders(java.lang.String, double, double, double)
	 */
	@Override
	@SuppressWarnings("unchecked")
	public Map<Double, User> findProviders(String serviceDescription, double longitude, double latitude, double distance, int maxResults, Collection<Integer> userToSkip) {
		Service service = serviceBo.getWithServiceName(serviceDescription);
		
		if (service == null) {
			return Collections.<Double, User>emptyMap();
		} else {
			/**
			 * Indexed with lucene, so using hibernate search full text queries.
			 */
			FullTextSession fullTextSession = Search.getFullTextSession(getDao().getCurrentSession());
			
			/**
			 * Would have made more sense to use user and embed the location index, but I did not work.
			 * We are using the spatial indexes for the location, so everything had to be embedded in 
			 * the locations indexes.
			 */
			QueryBuilder builder = fullTextSession.getSearchFactory().buildQueryBuilder()
					.forEntity(Location.class)
					.get();
			
			// The spatial distance query.
			org.apache.lucene.search.Query distanceQuery = builder
				.spatial()
				.within(milesToKM(distance), Unit.KM)
				.ofLatitude(latitude)
				.andLongitude(longitude)
			.createQuery();

			/**
			 * Get the current time to use to filter on only providers 
			 * available right now.
			 */
			Calendar cal = Calendar.getInstance();
			int hour = cal.get(Calendar.HOUR_OF_DAY);
			int dayOfWeek = cal.get(Calendar.DAY_OF_WEEK);
			String startField = getTimeFieldName(dayOfWeek, true);
			String endField = getTimeFieldName(dayOfWeek, false);
			long maxLastCheckin = System.currentTimeMillis() - MAX_LOCATION_AGE_MINUTES;
			log.error("Max checkin is set to filter nothing, must change before production.");
			maxLastCheckin = 1;
			
			/**
			 * Merge all of the queries together here.  Read comments for explanation, but should be straight forward.
			 */
			org.apache.lucene.search.Query availableQuery = builder
				.bool()
					.must(builder.keyword().onField("user.licenses.serviceId").matching(service.getServiceId()).createQuery()) // Must match the service id.
					.must(builder.range().onField("createdAt").below(maxLastCheckin).createQuery()).not() // Exclude created at before max last checkin.
					.must(builder.keyword().onField("expired").matching(false).createQuery()) // Don't get expired locations.
					.must(distanceQuery)
					.must(builder.range().onField(startField).above(hour).createQuery()).not() // Start not after now
					.must(builder.range().onField(endField).below(hour).createQuery()).not() // End not before now
				.createQuery();
			
			/**
			 * Set it up to include the distance in the result sets.
			 */
			org.hibernate.Query hibQuery = fullTextSession
				.createFullTextQuery(availableQuery, Location.class)
				.setProjection(FullTextQuery.SPATIAL_DISTANCE,  FullTextQuery.THIS)
				.setSpatialParameters(latitude, longitude, Spatial.COORDINATES_DEFAULT_FIELD)
				;

			List<Object[]> results = hibQuery
					.setMaxResults(maxResults > 0 ? maxResults : MAX_RESULTS)
					.setResultTransformer(Criteria.DISTINCT_ROOT_ENTITY)
					.list();

			/**
			 * The results come back as a list since we added projection on the distance.
			 */
			Map<Double, User> distanceMap = new HashMap<Double, User>();

			for (Object[] row : results) {
				Double distance_ = KMToMiles((Double) row[0]);
				Location l = (Location) row[1];

				log.debug(String.format("distance=%f location=%s",  distance_, l));
				l.getUser().setDistance(distance_);
				distanceMap.put(distance_, l.getUser());
			}
			
			return distanceMap;
		}
	}
	
	private static final String USER_SETTINGS_BASE = "user.settings.";
	private static final String START = "Start";
	private static final String END = "End";

	/**
	 * @param dayOfWeek
	 * @param isStart
	 * @return
	 */
	private String getTimeFieldName(int dayOfWeek, boolean isStart) {
		return String.format("%s.%s%s", USER_SETTINGS_BASE, getDayName(dayOfWeek), isStart ? START : END);
	}

	/**
	 * Gets the day string from the day of the week int to be used in the availability settings.
	 * 
	 * @param dayOfWeek
	 * @return
	 */
	private String getDayName(int dayOfWeek) {
		String day;

		switch(dayOfWeek) {
		case Calendar.SUNDAY:
			day = "sunday";
			break;
		case Calendar.MONDAY:
			day = "monday";
			break;
		case Calendar.TUESDAY:
			day = "tuesday";
			break;
		case Calendar.WEDNESDAY:
			day = "wednesday";
			break;
		case Calendar.THURSDAY:
			day = "thursday";
			break;
		case Calendar.FRIDAY:
			day = "friday";
			break;
		case Calendar.SATURDAY:
			day = "saturday";
			break;
		default:
			throw new IllegalArgumentException("Day of the week must be between 1 and 7.");
		}

		return day;
	}

}
