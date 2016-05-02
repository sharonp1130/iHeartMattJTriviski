package help.me.orm.dao;

import help.me.orm.entity.License;
import help.me.orm.entity.Service;
import help.me.orm.entity.User;

public interface ILicenseDao extends IDao<License> {
	
	/**
	 * Creates a new license.
	 * @param licenseNumber alpha numeric license number
	 * @param user user for the license
	 * @param serviceDescription service description to look up service.
	 * @return new license
	 */
	public License createNewLicense(String licenseNumber, User user, String serviceDescription);

	/**
	 * Creates a new license.
	 * @param licenseNumber alpha numeric license number
	 * @param user user for the license
	 * @param service service for license
	 * @return new license
	 */
	public License createNewLicense(String licenseNumber, User user, Service service);

	/**
	 * 
	 * @param licenseNumber
	 * @return
	 */
	public License findLicenseByNumber(String licenseNumber);
}
