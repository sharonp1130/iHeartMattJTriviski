package help.me.orm.bo;

import help.me.orm.entity.License;
import help.me.orm.entity.Service;
import help.me.orm.entity.User;

/**
 * @author triviski
 *
 */
public interface ILicenseBo extends IBo<License> {

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
	 * Find the license based on the license number.
	 * 
	 * @param licenseNumber
	 * @return the license or null if not found.
	 */
	public License findLicenseByNumber(String licenseNumber);

}
