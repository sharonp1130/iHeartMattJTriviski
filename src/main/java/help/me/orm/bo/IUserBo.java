package help.me.orm.bo;

import help.me.orm.entity.User;

public interface IUserBo {

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
	
	/**
	 * @param email
	 * @return
	 */
	User findByEmail(String email);
}
