package help.me.orm.dao.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.dao.ILicenseDao;
import help.me.orm.entity.License;
import help.me.orm.entity.Service;
import help.me.orm.entity.User;

/**
 * License DAO implementation.
 * 
 * @author triviski
 *
 */
@Repository("licenseDao")
public class LicenseDaoImpl extends CustomHibernateDAOSupport<License> implements ILicenseDao {
	@Autowired
	ServiceDaoImpl serviceDao;
	
	/**
	 * @param description
	 * @return service
	 */
	public Service getService(String description) {
		return serviceDao.getServiceWithDescription(description);
	}
	
	/* (non-Javadoc)
	 * @see help.me.orm.dao.ILicenseDao#createNewLicense(java.lang.String, help.me.orm.entity.User, java.lang.String)
	 */
	@Override
	public License createNewLicense(String licenseNumber, User user, String serviceDescription) {
		Service service = getService(serviceDescription);
		
		if (service == null) {
			throw new IllegalStateException("Invalid service description");
		} else {
			return this.createNewLicense(licenseNumber, user, service);
		}
	}

	/* (non-Javadoc)
	 * @see help.me.orm.dao.ILicenseDao#createNewLicense(java.lang.String, help.me.orm.entity.User, help.me.orm.entity.Service)
	 */
	@Override
	public License createNewLicense(String licenseNumber, User user, Service service) {
		License license = new License();
		license.setLicenseNumber(licenseNumber);
		license.setUser(user);
		license.setService(service);
		
		save(license);
		
		return license;
	}
}

