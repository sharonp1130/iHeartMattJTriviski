package help.me.orm.bo;

import help.me.orm.entity.User;

public interface IUserBo extends IBo<User>{
	
	/**
	 * @param email
	 * @return
	 */
	public User findByEmail(String email);
}
