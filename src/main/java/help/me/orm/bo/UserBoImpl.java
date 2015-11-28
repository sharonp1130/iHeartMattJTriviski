package help.me.orm.bo;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import help.me.orm.dao.impl.UserDaoImpl;
import help.me.orm.entity.User;

@Service("userBo")
public class UserBoImpl implements IUserBo {

	@Autowired
	UserDaoImpl userDao;
	
	/**
	 * @param userDao
	 */
	public void setUserDao(UserDaoImpl userDao) {
		this.userDao = userDao;
	}
	
	@Override
	public void save(User user) {
		userDao.save(user);

	}

	@Override
	public void update(User user) {
		userDao.update(user);
	}

	@Override
	public void delete(User user) {
		userDao.delete(user);
	}

	@Override
	public void saveOrUpdate(User user) {
		userDao.saveOrUpdate(user);
	}

	@Override
	public User findByEmail(String email) {
		return userDao.findByEmail(email);
	}

}
