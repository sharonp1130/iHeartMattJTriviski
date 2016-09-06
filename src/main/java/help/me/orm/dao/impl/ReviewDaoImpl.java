package help.me.orm.dao.impl;

import java.util.Collection;

import org.hibernate.criterion.Restrictions;
import org.springframework.stereotype.Repository;

import help.me.orm.dao.IReviewDao;
import help.me.orm.entity.Review;
import help.me.orm.entity.User;

@Repository("reviewDao")
public class ReviewDaoImpl extends CustomHibernateDAOSupport<Review>  implements IReviewDao {
	public static final String REVIEWER_COLUMN = "reviewer";
	public static final String PROVIDER_COLUMN = "provider";

	@Override
	public Collection<Review> getUserReviews(User reviewer) {
		Collection<?> results = getCurrentSession().createCriteria(Review.class)
				.add(Restrictions.eq(REVIEWER_COLUMN, reviewer))
				.list();

		return castCollection(results);
	}

	@Override
	public Collection<Review> getReviews(User provider) {
		Collection<?> results = getCurrentSession().createCriteria(Review.class)
				.add(Restrictions.eq(PROVIDER_COLUMN, provider))
				.list();

		return castCollection(results);
	}

	@Override
	public Collection<Review> findReviews(User reviewer, User provider) {
		Collection<?> results = getCurrentSession().createCriteria(Review.class)
				.add(Restrictions.eq(REVIEWER_COLUMN, reviewer))
				.add(Restrictions.eq(PROVIDER_COLUMN, provider))
				.list();

		return castCollection(results);
	}



}
