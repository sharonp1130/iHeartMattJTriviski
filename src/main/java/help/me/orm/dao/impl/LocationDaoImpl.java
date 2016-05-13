package help.me.orm.dao.impl;

import org.hibernate.criterion.Order;
import org.hibernate.criterion.Restrictions;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.dao.ILocationDao;
import help.me.orm.dao.IUserDao;
import help.me.orm.entity.Location;
import help.me.orm.entity.User;

/**
 * Location DAO implementation.
 * 
 * @author triviski
 *
 */
@Repository("locationDao")
public class LocationDaoImpl extends CustomHibernateDAOSupport<Location> implements ILocationDao {

	@Autowired
	IUserDao userDao;
	
	/* (non-Javadoc)
	 * @see help.me.orm.dao.ILocationDao#addLocation(help.me.orm.entity.User, double, double)
	 */
	@Override
	public Location addLocation(User user, double longitude, double latitude) {
		/**
		 * Expire all of the old locations of the user before moving on.
		 */
		for (Location loc : user.getLocations()) {
			loc.setIsExpired(true);
		}
		Location location = new Location();
		location.setLongitude(longitude);
		location.setLatitude(latitude);
		location.setUser(user);
		location.setCreatedAt(System.currentTimeMillis());
		
		
		save(location);
		
		return location;
	}

	/* (non-Javadoc)
	 * @see help.me.orm.dao.ILocationDao#addLocation(java.lang.String, double, double)
	 */
	@Override
	public Location addLocation(String email, double longitude, double latitude) {
		User user = userDao.findByEmail(email);
		
		return user == null ? null : addLocation(user, longitude, latitude);
	}
	
	/* (non-Javadoc)
	 * @see help.me.orm.dao.ILocationDao#getLastLocation(help.me.orm.entity.User)
	 */
	@Override
	public Location getLastLocation(User user) {
		Location loc = (Location) getCurrentSession()
			.createCriteria(Location.class)
			.add(Restrictions.eq("user", user))
			.addOrder(Order.asc("locationId"))
			.setMaxResults(1)
			.uniqueResult();
		
		return loc;
	}

	/* (non-Javadoc)
	 * @see help.me.orm.dao.ILocationDao#getLastLocation(java.lang.String)
	 */
	@Override
	public Location getLastLocation(String email) {
		User user = userDao.findByEmail(email);
		
		return user == null ? null : getLastLocation(user);
	}
}

