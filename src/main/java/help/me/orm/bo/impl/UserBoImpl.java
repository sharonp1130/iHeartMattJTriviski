package help.me.orm.bo.impl;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.IUserBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.impl.UserDaoImpl;
import help.me.orm.entity.User;

@Repository("userBo")
public class UserBoImpl implements IUserBo {

	@Autowired
	UserDaoImpl userDao;
	
	@Override
	public User findByEmail(String email) {
		return userDao.findByEmail(email);
	}

	@Override
	public IDao<User> getDao() {
		return userDao;
	}

}
