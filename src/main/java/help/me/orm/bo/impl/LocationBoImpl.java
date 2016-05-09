package help.me.orm.bo.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.ILocationBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.impl.LocationDaoImpl;
import help.me.orm.entity.Location;
import help.me.orm.entity.User;

/**
 * @author triviski
 *
 */
@Repository("locationBo")
public class LocationBoImpl implements ILocationBo {
	
	@Autowired
	LocationDaoImpl dao;

	/* (non-Javadoc)
	 * @see help.me.orm.bo.IBo#getDao()
	 */
	@Override
	public IDao<Location> getDao() {
		return dao;
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.ILocationBo#addLocation(help.me.orm.entity.User, double, double)
	 */
	@Override
	public Location addLocation(User user, double longitude, double latitude) {
		expireLocations(user);

		return dao.addLocation(user, longitude, latitude);
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.ILocationBo#addLocation(java.lang.String, double, double)
	 */
	@Override
	public Location addLocation(String email, double longitude, double latitude) {
		return dao.addLocation(email, longitude, latitude);
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.ILocationBo#getLastLocation(help.me.orm.entity.User)
	 */
	@Override
	public Location getLastLocation(User user) {
		return dao.getLastLocation(user);
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.ILocationBo#getLastLocation(java.lang.String)
	 */
	@Override
	public Location getLastLocation(String email) {
		return dao.getLastLocation(email);
	}

	@Override
	public void expireLocations(User user) {
		user.getLocations().stream().forEach(location -> location.expire());
	}
}
