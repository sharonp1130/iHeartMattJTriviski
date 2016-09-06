package help.me.orm.dao;

import java.util.Collection;

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

	/**
	 * A broader way to search.  All inputs are optional, however a
	 * single value must not be null.
	 *
	 * @param businessName the businessName
	 * @param firstName the first name
	 * @param lastName the last name
	 * @param email the email
	 * @param phone the phone number
	 * @return
	 *
	 * @throws DaoInputException All inputs are null.
	 */
	public Collection<User> search(String businessName,
			String firstName,
			String lastName,
			String email,
			String phone) throws DaoInputException;
}
