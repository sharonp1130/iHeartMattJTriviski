package help.me.orm.bo.impl;

import java.util.Collection;

import javax.transaction.Transactional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Repository;

import help.me.orm.bo.IReviewBo;
import help.me.orm.dao.IDao;
import help.me.orm.dao.IReviewDao;
import help.me.orm.dao.impl.ReviewDaoImpl;
import help.me.orm.entity.Review;
import help.me.orm.entity.User;

@Repository("reviewBo")
public class ReviewBoImpl implements IReviewBo {

	@Autowired
	ReviewDaoImpl dao;

	@Override
	public IDao<Review> getDao() {
		return dao;
	}

	@Override
	@Transactional
	public Review addReview(User reviewer, User provider, double rating, String message) {
		Review review = new Review(rating, message, reviewer, provider);
		save(review);
		return review;
	}

	@Override
	@Transactional
	public Collection<Review> getUserReviews(User reviewer) {
		return dao.getUserReviews(reviewer);
	}

	@Override
	public Collection<Review> getReviews(User provider) {
		return dao.getReviews(provider);
	}

}
