package help.me.orm.bo;

import help.me.orm.entity.License;
import help.me.orm.entity.Location;
import help.me.orm.entity.User;

public interface IUserBo extends IBo<User>{
	
	/**
	 * @param email
	 * @return Found user or null.
	 */
	public User findByEmail(String email);
	
	/**
	 * Looks up the user.  If null, creates a new user and returns.
	 * @param email
	 * @return Found user or new user.
	 */
	public User findByEmailOrCreate(String email);
	
	/**
	 * Gets the most recent location of user.
	 * 
	 * @param user
	 * @return last known location.
	 */
	public Location getLastLocation(User user);
	
	/**
	 * @param email
	 * @return last known location.
	 */
	public Location getLastLocation(String email);

	/**
	 * @param user
	 * @param longitude
	 * @param latitude
	 * @return New location object
	 */
	public Location addLocation(User user, double longitude, double latitude);
	
	/**
	 * @param email
	 * @param longitude
	 * @param latitude
	 * @return New location object
	 */
	public Location addLocation(String email, double longitude, double latitude);

	/**
	 * Looks up the service with the description and creates a new service if necessary.  
	 * Creates a license and adds to the user.  If the license exists does nothing.
	 * 
	 * @param licenseId
	 * @param serviceDescription
	 * @return newly created license
	 */
	public License addLicense(User user, String licenseNum, String serviceDescription);
}
