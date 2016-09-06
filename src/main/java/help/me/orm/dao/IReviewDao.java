package help.me.orm.dao;

import java.util.Collection;

import help.me.orm.entity.Review;
import help.me.orm.entity.User;

public interface IReviewDao extends IDao<Review> {

	/**
	 * Get a list of reviews submitted by reviewer
	 * @param reviewer the reviewer to get reviews for
	 * @return collection of reviews
	 */
	public Collection<Review> getUserReviews(User reviewer);

	/**
	 * Find a review of provider by reviewer.
	 * @param reviewer
	 * @param provider
	 * @return the reviews
	 */
	public Collection<Review> findReviews(User reviewer, User provider);

	/**
	 * Get a list of reviews for a provider.
	 *
	 * @param provider the provider the reviews are submitted for.
	 * @return a collection of reviews
	 */
	public Collection<Review> getReviews(User provider);

}
