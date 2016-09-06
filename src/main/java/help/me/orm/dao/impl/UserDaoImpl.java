package help.me.orm.dao.impl;

import java.util.Collection;
import java.util.List;

import org.hibernate.Criteria;
import org.hibernate.criterion.Restrictions;
import org.springframework.stereotype.Repository;

import help.me.orm.dao.DaoInputException;
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

	/* (non-Javadoc)
	 * @see help.me.orm.dao.IUserDao#findByEmail(java.lang.String)
	 */
	@Override
	public User findByEmail(String email) {
		List<?> results = getCurrentSession().createCriteria(User.class)
				.add(Restrictions.eq("email", email))
				.list();

		return results.isEmpty() ? null : (User) results.get(0);
	}

	@Override
	public Collection<User> search(String businessName, String firstName, String lastName, String email, String phone) throws DaoInputException {
		if (businessName == null &&
			firstName == null &&
			lastName == null &&
			email == null &&
			phone == null) {
			throw new DaoInputException("At least one input must not be null");
		} else {
			Criteria query = getCurrentSession().createCriteria(User.class);

			// User values
			if (email != null) {
				query.add(Restrictions.eq("email", email));
			}

			if (firstName != null) {
				query.add(Restrictions.eq("firstName", firstName));
			}

			if (lastName != null) {
				query.add(Restrictions.eq("lastName", lastName));
			}

			// Info values
			if (businessName != null) {
				query.add(Restrictions.eq("info.businessName", businessName));
			}

			if (phone != null) {
				query.add(Restrictions.eq("info.phoneNumber", phone));
			}

			return castCollection(query.list());
		}
	}
}
