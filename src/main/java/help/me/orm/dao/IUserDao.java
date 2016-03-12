package help.me.orm.dao;

import help.me.orm.entity.User;

/**
 * DAO interface for user.
 * 
 * @author triviski
 *
 */
public interface IUserDao  extends IDao<User> {
	
	/**
	 * Find the user by the email address
	 * @param email
	 * @return User or null if not found.
	 */
	public User findByEmail(String email);
}
