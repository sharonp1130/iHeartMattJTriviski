package help.me.orm.dao.impl;

import java.util.List;

import org.hibernate.criterion.DetachedCriteria;
import org.hibernate.criterion.Restrictions;
import org.springframework.context.ApplicationContext;
import org.springframework.stereotype.Repository;

import help.me.orm.dao.IUserDao;
import help.me.orm.entity.User;

/**
 * User DAO implementation.
 * 
 * @author triviski
 *
 */
@Repository("userDao")
public class UserDaoImpl extends CustomHibernateDAOSupport<User> implements IUserDao {
	
	@Override
	public User findByEmail(String email) {
		DetachedCriteria crit = DetachedCriteria.forClass(User.class)
				.add(Restrictions.eq("user.email", email));
				
		List<?> results = getHibernateTemplate().findByCriteria(crit);
		return results.isEmpty() ? null : (User) results.get(0);
	}
}
