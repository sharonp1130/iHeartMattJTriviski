package help.me.orm.dao;

import help.me.orm.entity.User;

/**
 * @author triviski
 *
 */
public interface IUserDao {
	
	/**
	 * @param user
	 */
	void save(User user);
	/**
	 * @param user
	 */
	void update(User user);
	/**
	 * @param user
	 */
	void delete(User user);
	
	/**
	 * @param user
	 */
	void saveOrUpdate(User user);
	
	User findByEmail(String email);
}
