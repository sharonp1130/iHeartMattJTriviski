package help.me.orm.bo.impl;

import java.util.Collection;
import java.util.Collections;
import java.util.List;
import java.util.stream.Collectors;

import org.hibernate.Criteria;
import org.hibernate.criterion.Projections;
import org.hibernate.criterion.Restrictions;
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
	
	/* (non-Javadoc)
	 * @see help.me.orm.dao.ILicenseDao#findProviders(java.lang.String, double, double, double)
	 */
	@Override
	@SuppressWarnings("unchecked")
	public Collection<User> findProviders(String serviceDescription, double longitude, double latitude, double distance, int maxResults, Collection<Integer> userToSkip) {
		Service service = serviceBo.getServiceWithDescription(serviceDescription);
		
		if (service == null) {
			return Collections.emptyList();
		} else {
			Criteria crit = getDao().getCurrentSession().createCriteria(License.class)
				.add(Restrictions.eq("service", service))
				.setProjection(Projections.property("user"));
			
			if (!userToSkip.isEmpty()) {
				crit.add(Restrictions.not(Restrictions.in("user.userId", userToSkip)));
			}
			
			if (maxResults > 0) {
				crit.setMaxResults(maxResults);
			}

			Collection<User> results = crit.list();
			
			List<User> filtered = results.parallelStream()
					.filter((user) -> withinDistnace(user, longitude, latitude, distance))
					.collect(Collectors.toList());
			
			 return filtered;
		}
	}
}
