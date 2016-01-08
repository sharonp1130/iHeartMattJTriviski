package help.me.orm.bo.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.ILocationBo;
import help.me.orm.bo.IUserBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.impl.UserDaoImpl;
import help.me.orm.entity.License;
import help.me.orm.entity.Location;
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
	ILocationBo locationBo;
	
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
}
