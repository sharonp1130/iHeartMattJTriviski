package help.me.orm.dao;

import help.me.orm.entity.Location;
import help.me.orm.entity.User;

public interface ILocationDao extends IDao<Location> {
	
	/**
	 * @param user
	 * @param longitude
	 * @param lattitude
	 * @return New location object
	 */
	public Location addLocation(User user, double longitude, double lattitude);
	
	/**
	 * @param email
	 * @param longitude
	 * @param lattitude
	 * @return New location object
	 */
	public Location addLocation(String email, double longitude, double lattitude);
	
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
