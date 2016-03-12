package help.me.orm.bo.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.ILicenseBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.impl.LicenseDaoImpl;
import help.me.orm.entity.License;
import help.me.orm.entity.Service;
import help.me.orm.entity.User;

@Repository("licenseBo")
public class LicenseBoImpl implements ILicenseBo {
	@Autowired
	LicenseDaoImpl dao;
	
	/* (non-Javadoc)
	 * @see help.me.orm.bo.IBo#getDao()
	 */
	@Override
	public IDao<License> getDao() {
		return dao;
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.ILicenseBo#createNewLicense(java.lang.String, help.me.orm.entity.User, java.lang.String)
	 */
	@Override
	public License createNewLicense(String licenseNumber, User user, String serviceDescription) {
		return dao.createNewLicense(licenseNumber, user, serviceDescription);
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.ILicenseBo#createNewLicense(java.lang.String, help.me.orm.entity.User, help.me.orm.entity.Service)
	 */
	@Override
	public License createNewLicense(String licenseNumber, User user, Service service) {
		return dao.createNewLicense(licenseNumber, user, service);
	}

	/* (non-Javadoc)
	 * @see help.me.orm.bo.ILicenseBo#findLicenseByNumber(java.lang.String)
	 */
	@Override
	public License findLicenseByNumber(String licenseNumber) {
		return dao.findLicenseByNumber(licenseNumber);
	}
}
