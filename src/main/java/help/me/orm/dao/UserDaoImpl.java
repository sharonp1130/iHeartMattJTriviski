package help.me.orm.dao;

import java.util.List;

import org.hibernate.criterion.DetachedCriteria;
import org.hibernate.criterion.Restrictions;
import org.springframework.stereotype.Repository;

import help.me.orm.entity.User;

/**
 * User DAO implementation.
 * 
 * @author triviski
 *
 */
@Repository("userDao")
public class UserDaoImpl extends CustomHibernateDAOSupport implements IUserDao {

	@Override
	public void save(User user) {
		getHibernateTemplate().save(user);
	}

	@Override
	public void update(User user) {
		getHibernateTemplate().update(user);
	}

	@Override
	public void delete(User user) {
		getHibernateTemplate().delete(user);
	}
	
	@Override
	public void saveOrUpdate(User user) {
		getHibernateTemplate().saveOrUpdate(user);
	}
	
	@Override
	public User findByEmail(String email) {
		DetachedCriteria crit = DetachedCriteria.forClass(User.class)
				.add(Restrictions.eq("user.email", email));
				
		List<?> results = getHibernateTemplate().findByCriteria(crit);
		return results.isEmpty() ? null : (User) results.get(0);
	}
}
