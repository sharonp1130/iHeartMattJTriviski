package help.me.rest.resources;

import javax.transaction.Transactional;
import javax.validation.constraints.NotNull;
import javax.ws.rs.Consumes;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.QueryParam;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import help.me.orm.bo.IReviewBo;
import help.me.orm.bo.IUserBo;
import help.me.orm.entity.Review;
import help.me.orm.entity.User;
import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;

@Component
@Scope(value="request")
@Path("review")
@Api(value="Resource for creating and receiving user reviews")
public class ReviewResource extends BaseResource {

	@Autowired
	IReviewBo reviewBo;

	@Autowired
	IUserBo userBo;

	@POST
	@Path("reviewer/{reviewerId : \\d+}/provider/{providerId : \\d+}")
	@Consumes(MediaType.TEXT_PLAIN)
	@Transactional
	@ApiOperation(value="Add a new review.")
	public Response addReview(
			@PathParam("reviewerId") int reviewerId,
			@PathParam("providerId") int providerId,
			@QueryParam("rating") double rating,
			@NotNull String message
			) {

		if (rating < 0 || rating > 5) {
			return response("Rating must be a float 0 to 5", Response.Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
		} else if (reviewerId == providerId) {
			return response("Nice try!  A provider can not rate themself.", Response.Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
		}

		User reviewer = userBo.findById(reviewerId);
		User provider = userBo.findById(providerId);

		if (reviewer == null ) {
			return serverError("No user was found for reviewer with ID " + reviewerId);
		} else if (provider == null ) {
			return serverError("No user was found for provider with ID " + providerId);
		} else {

			Review review = new Review(rating, message, reviewer, provider);

			reviewer.addWrittenReview(review);
			provider.addProviderReview(review);

			try {
				userBo.save(provider);
				userBo.save(reviewer);

				return okay();
			} catch (Exception e) {
				e.printStackTrace();
				return serverError(e);
			}
		}
	}
}
