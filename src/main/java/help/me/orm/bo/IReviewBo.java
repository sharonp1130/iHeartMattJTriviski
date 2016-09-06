package help.me.orm.bo;

import java.util.Collection;

import help.me.orm.entity.Review;
import help.me.orm.entity.User;

public interface IReviewBo extends IBo<Review> {

	/**
	 * Add a new review.
	 *
	 * @param reviewer the user submitting a review
	 * @param provider the user the review is for
	 * @param rating the rating, from 0 to 5.
	 * @param message text for the review.
	 *
	 * @return the newly created review.
	 */
	public Review addReview(User reviewer, User provider, double rating, String message);


	/**
	 * Get a list of reviews submitted by reviewer
	 * @param reviewer the reviewer to get reviews for
	 * @return collection of reviews
	 */
	public Collection<Review> getUserReviews(User reviewer);

	/**
	 * Get a list of reviews for a provider.
	 *
	 * @param provider the provider the reviews are submitted for.
	 * @return a collection of reviews
	 */
	public Collection<Review> getReviews(User provider);
}
