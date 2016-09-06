package help.me.rest.resources;

import java.text.SimpleDateFormat;
import java.util.Calendar;

import javax.transaction.Transactional;
import javax.validation.constraints.NotNull;
import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
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
	public Response addReview(
			@PathParam("reviewerId") int reviewerId,
			@PathParam("providerId") int providerId,
			@QueryParam("rating") double rating,
			@NotNull String message
			) {

		if (rating < 0 || rating > 5) {
			return response("Rating must be a float 0 to 5", Response.Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
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

	/**
	 * @param review The review to save.
	 * @return
	 */
//	@POST
////	@Path("reviewer/{reviewerId : \\d+}/provider/{providerId : \\d+}")
////	@Path("reviewer/{reviewerId : \\d+}")
////	@Path("reviewer/{reviewerId : \\d+}/provider/{providerId : \\d+}")
//	@Path("{reviewerId : \\d+}/{providerId}")
//	@Transactional
//	@ApiOperation(value="Add a new review.",
//		notes="Example JSON input body: { 'longitude' : 12345.99, 'latitude' : 33445.123 }"
//	)
////	@ApiResponses(value={
////			@ApiResponse(code=200, message="Location added successfully", response=Location.class),
////			@ApiResponse(code=404, message="No user found with ID supplied"),
////			@ApiResponse(code=400, message="Invalid or unset longitude / lattitude.")
////	})
//	public Response addReview(
//			@PathParam("reviewerId") int reviewerId,
//			@PathParam("providerId") String providerIds,
//			@NotNull @QueryParam("rating") double rating
////			@NotNull String message
//			) {
//
//		int providerId = 1;
//		String message = "this is a message";
//		User reviewer = userBo.findById(reviewerId);
//		User provider = userBo.findById(providerId);
//
//		if (reviewer == null ) {
//			return serverError("No user was found for reviewer with ID " + reviewerId);
//		} else if (provider == null ) {
//			return serverError("No user was found for provider with ID " + providerId);
//		} else {
//
//			Review review = new Review(rating, message, reviewer, provider);
//
//			reviewer.addWrittenReview(review);
//			provider.addProviderReview(review);
//
//			try {
//				userBo.save(provider);
//				userBo.save(reviewer);
//
//				return okay();
//			} catch (Exception e) {
//				e.printStackTrace();
//				return serverError(e);
//			}
//		}
//	}

	@GET
	@Path("/ping")
	@Produces(MediaType.TEXT_PLAIN)
	public Response helloWorld() {
		return Response.ok(String.format("GET: Pong! %s", new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss").format(Calendar.getInstance().getTime()))).build();
	}
	@POST
	@Path("/ping")
	@Produces(MediaType.TEXT_PLAIN)
	public Response helloWorldPost() {
		return Response.ok(String.format("POST: Pong! %s", new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss").format(Calendar.getInstance().getTime()))).build();
	}
}
