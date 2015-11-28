package help.me.orm.dao;

import help.me.orm.entity.User;

/**
 * DAO interface for user.
 * 
 * @author triviski
 *
 */
public interface IUserDao {
	
	public User findByEmail(String email);
}
