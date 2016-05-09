package help.me.orm.bo;

import help.me.orm.entity.Location;
import help.me.orm.entity.User;

public interface ILocationBo extends IBo<Location> {
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
	 * @param user
	 */
	public void expireLocations(User user);
	
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

}
