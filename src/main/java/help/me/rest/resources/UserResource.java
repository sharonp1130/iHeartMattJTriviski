package help.me.rest.resources;

import java.util.Set;

import javax.validation.constraints.NotNull;
import javax.ws.rs.Consumes;
import javax.ws.rs.DELETE;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.PUT;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.Response.Status;

import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.entity.Info;
import help.me.orm.entity.License;
import help.me.orm.entity.Service;
import help.me.orm.entity.Settings;
import help.me.orm.entity.User;
import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;
import io.swagger.annotations.ApiResponse;
import io.swagger.annotations.ApiResponses;

/**
 * Jersey resource class for account information.  
 * 
 * This is used to look up user account information, add an account, 
 * update and delete.  Basically, all the account stuff balls.
 * 
 * @author triviski
 *
 */
@Component
@Scope(value="request")
@Path("user")
@Api(value="User resource to find users, create new users and update user information.")
public class UserResource extends BaseResource {
	
	/**
	 * @param userId
	 * @return
	 */
	@GET
	@Path("{userId : \\d+}")
	@Produces(MediaType.APPLICATION_JSON)
	@Transactional
	@ApiOperation(value="Retrieve a user with the user ID.", response=User.class)
	@ApiResponses(@ApiResponse(code=404, message="User ID not found."))
	public Response getUser(@PathParam("userId") int userId) {
		User user = userBo.findById(userId);
		
		return user == null ? 
				notFound() :
				okay(user);
	}

	/**
	 * Find a user object with the email.
	 * 
	 * The user json wil
	 * 
	 * @param email
	 * @return The user found by email or empty entity with status 404.
	 */
	@GET
	@Produces(MediaType.APPLICATION_JSON)
	@ApiOperation(value="Retrieve a user with the email.", 
		notes="Email is a unique field and this method will always return either an empty set or the given user",
		response=User.class)
	@ApiResponses(@ApiResponse(code=404, message="User with email supplied does not exist."))
	public Response checkUserAccount(@NotNull @QueryParam("email") String email) {
		User user;
		
//		if (userId == null) {
//			user = userBo.findById(userId);
//		} else {
//			user = userBo.findByEmail(email);
//		}
		
		user = userBo.findByEmail(email);

		return user == null ? 
				notFound() :
				okay(user);
	}
	
	/**
	 * Find the user info for user with id userId
	 * @param userId
	 * @return info for user with id userId.
	 */
	@GET
	@Path("/{userId : \\d+}/info")
	@Produces(MediaType.APPLICATION_JSON)
	@ApiOperation(value="Retrieve the user info for specified user ID.",
			response=Info.class,
			notes="In the event that the account was created but not completed some of the info values could be null.")
	@ApiResponses(@ApiResponse(code=404, message="User with supplied user ID does not exist."))
	public Response getUserInfo(@PathParam("userId") int userId) {
		User user = userBo.findById(userId);
		
		if (user == null) {
			return notFound();
		}
		
		Info info = user.getInfo();
		
		if (info == null) {
			log.error(String.format("Info for user not found: %s", user));
			return notFound();
		} else {
			return okay(info);
		}
	}

	/**
	 * Find the user settings for user with id userId
	 * @param userId
	 * @return info for user with id userId.
	 */
	@GET
	@Path("/{userId : \\d+}/availability")
	@Produces(MediaType.APPLICATION_JSON)
	@ApiOperation(value="Retrieve the availability for specified user ID.",
			response=Settings.class,
			notes="Some values may be null if start / end times were not supplied for a given day.")
	@ApiResponses(@ApiResponse(code=404, message="User with supplied user ID does not exist."))
	public Response getUserSettings(@PathParam("userId") int userId) {
		User user = userBo.findById(userId);
		
		if (user == null) {
			return notFound();
		}
		
		Settings settings = user.getSettings();
		
		if (settings == null) {
			log.error(String.format("Settings for user not found: %s", user));
			return notFound();
		} else {
			return okay(settings);
		}
	}

	/**
	 * Find the user licenses for user with id userId
	 * @param userId
	 * @return info for user with id userId.
	 */
	@GET
	@Path("/{userId : \\d+}/licenses")
	@Produces(MediaType.APPLICATION_JSON)
	@ApiOperation(value="Retrieve the set of licenses for specified user ID.",
			response=License.class,
			responseContainer="List"
	)
	@ApiResponses(@ApiResponse(code=404, message="User with supplied user ID does not exist."))
	public Response getUserLicenses(@PathParam("userId") int userId) {
		User user = userBo.findById(userId);
		
		if (user == null) {
			return notFound();
		}
		
		Set<License> licenses = user.getLicenses();
		
		if (licenses == null || licenses.isEmpty()) {
			log.error(String.format("Licenses for user not found: %s", user));
			return notFound();
		} else {
			return okay(licenses);
		}
	}
	
	/**
	 * Deletes a user.
	 * @param userId
	 * @return
	 */
	@DELETE
	@Path("/{userId : \\d+}")
	@Produces(MediaType.TEXT_PLAIN)
	@Transactional
	@ApiOperation(value="Delete user with specified user ID.")
	@ApiResponses(@ApiResponse(code=404, message="User with supplied user ID does not exist."))
	public Response deleteUser(@PathParam("userId") int userId) {
		User user = userBo.findById(userId);
		
		if (user == null) {
			return notFound(String.format("No user found for userId %d", userId));
		} else {
			userBo.delete(user);
			
			return okay();
		}
	}
	
	/**
	 * Used to update the user.  If one does not exist, this will return a 404.
	 * 
	 * @param user
	 * @return OK if found and updated else 404 if not found.
	 */
	@POST
	@Path("/{userId : \\d+}")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
	@ApiOperation(value="Update user with specified user ID.",
			notes="NOTE:  Email is a unique field and is never upadted.  Example JSON input: { 'email' : 'someemail@gmail.com', 'firstName' : 'fred', 'lastName' : 'smith', 'isProvider' : true }",
			response=User.class
	)
	@ApiResponses({
			@ApiResponse(code=404, message="User with supplied user ID does not exist."), 
			@ApiResponse(code=200, message="User was updated.  Responds with updated user", response=User.class)
	})
	public Response updateUser(@PathParam("userId") int userId, User user) {
		User user_ = userBo.findById(userId);
		
		if (user_ == null) {
			return response(String.format("No user was found with userId %d", userId), Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
		} else {
			user_.merge(user);
			userBo.saveOrUpdate(user_);
			
			return okay(user_);
		}
	}

	/**
	 * Creates a new user.  If all is good returns the new users JSON. 
	 * 
	 * @param user
	 * @return Response with status.
	 */
	@PUT
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.APPLICATION_JSON)
	@Transactional
	@ApiOperation(value="Create a new user.",
			notes="Example JSON input: { 'email' : 'someemail@gmail.com', 'firstName' : 'fred', 'lastName' : 'smith', 'isProvider' : true }"
	)
	@ApiResponses({
			@ApiResponse(code=500, message="Unknown error"),
			@ApiResponse(code=200, message="New user was created.", response=User.class)
			})
	public Response newUser(User user) throws Exception {
		/**
		 * If the user exists just return...check the values?
		 */
		User user_ = userBo.findByEmail(user.getEmail());
		
		if (user_ != null) {
			return okay(user_);
		} else {
			// Create a new user and return it.
			userBo.saveOrUpdate(user);
			return okay(user);
		}
	}
	
	/**
	 * Adds or updates the info for a user.  Not going to get too crazy here with PUT vs POST.  If the user
	 * is already created will merge them.  Else will just set it in the user objedct. 
	 * @param userId
	 * @param info
	 * @return
	 */
	@POST
	@Path("/{userId : \\d+}/info")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
	@ApiOperation(value="Add or update user info with specified user ID.",
			notes="Example JSON input: { 'businessName' : 'my business', 'address' : 'new business address', "
					+ "'city' : 'st. paul', 'zipcode' : '12345', 'phone' : '(818) 112-1345', "
					+ "'phoneOk' : true, 'textOk' : true, 'emailOk' : true}",
			response=Info.class
	)
	@ApiResponses({
			@ApiResponse(code=404, message="User with supplied user ID does not exist."), 
			@ApiResponse(code=200, message="User info was added or updated successfully.", response=Info.class)
	})
	public Response addOrUpdateInfo(@PathParam("userId") int userId, Info info) {
		User user = userBo.findById(userId);
		
		if (user == null) {
			return response(String.format("No user was found with userId %d", userId), Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
		} else if (user.getInfo() != null) {  
			/**
			 * Info already exists and is going to get updated by a merge.
			 * Set the ID of the new info so it will get merged.
			 */
			info.setInfoId(user.getInfo().getInfoId());
			Info updatedInfo = infoBo.merge(info);
			return okay(updatedInfo);
			
		} else { 
			/**
			 * New info object is being created.
			 */
			user.setInfo(info);
			info.setUser(user);

			/**
			 * Just need to save the user and will cascade to the info.
			 */
			userBo.save(user);
			
			return okay(user.getInfo());
		}
	}
	
	
	/**
	 * Adds a new settings to the given user if none exist.  If it exists, merges
	 * the new settings with the old.
	 * 
	 * @param userId
	 * @param settings
	 * @return
	 */
	@POST
	@Path("/{userId : \\d+}/availability")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
	@ApiOperation(value="Add or update user availability with specified user ID.",
			notes="Example JSON input: { 'mondayStart' : null, 'mondayEnd' : '00:00:31', "
					+ "'tuesdayStart' : null, 'tuesdayEnd' : null, "
					+ "'wednesdayStart' : null, 'wednesdayEnd' : null, "
					+ "'thursdayStart' : null, 'thursdayEnd' : null, "
					+ "'fridayStart' : null, 'fridayEnd' : null, "
					+ "'saturdayStart' : null, 'saturdayEnd' : null, "
					+ "'sundayStart' : null, 'sundayEnd' : '12:00:00' }."
					+ "  NOTE:  The example shows a complete JSON input.  Not all key / value pairs are required. "
					+ "Updates will be made to the key / value pairs that are present and the values are valide.",
			response=Settings.class
	)
	@ApiResponses({
			@ApiResponse(code=404, message="User with supplied user ID does not exist."), 
			@ApiResponse(code=200, message="User availability was added or updated successfully.", response=Settings.class)
	})
	public Response addOrUpdateSettings(@PathParam("userId") int userId, Settings settings) {
		User user = userBo.findById(userId);
		
		if (user == null) {
			return response(String.format("No user was found with userId %d", userId), Status.NOT_FOUND, MediaType.TEXT_PLAIN_TYPE);
		} else if (user.getSettings() != null) {
			// Settings already exists so 
			/**
			 * Settings already exists and is going to get updated by a merge.
			 * Set the ID of the new settings so it will get merged.
			 */
			Settings settings_ = user.getSettings();
			settings_.updateValuesFromOther(settings);
			userBo.saveOrUpdate(user);
			
			return okay(settings_);
			
		} else { 
			settings.setUser(user);
			user.setSettings(settings);
			
			userBo.save(user);
			
			return okay(user.getSettings());
		}
	}
	
	/**
	 * @param userId
	 * @param license
	 * @return
	 */
	@PUT
	@Path("/{userId : \\d+}/license")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
	@ApiOperation(value="Add a new licese for user with specified user ID.",
			notes="Example JSON input: {'licenseNumber' : 'PLUMB123', 'service' : 'plubming'}"
	)
	@ApiResponses({
			@ApiResponse(code=404, message="User with supplied user ID does not exist."), 
			@ApiResponse(code=400, message="A different user has owns license number supplied."),
			@ApiResponse(code=200, message="New license was created or existing license that matched input values was found.", response=License.class)
	})
	public Response addLicense(@PathParam("userId") int userId, License license) {
		User user = userBo.findById(userId);
		License license_ = licenseBo.findLicenseByNumber(license.getLicenseNumber());
		
		if (user == null) {
			return response(String.format("No user was found with userId %d", userId), 
					Status.NOT_FOUND, MediaType.TEXT_PLAIN_TYPE);
		} else if (license_ != null && user.equals(license_.getUser())) {
			return okay(license_);
		} else if (license_ != null && !user.equals(license_.getUser())) {
			return response(String.format("A different user owns licenseNumber %s", license.getLicenseNumber()), 
					Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
		} else {
			/**
			 * The service for the license is a stub.  We need to get the actual 
			 * service and and set it properly.
			 */
			Service service = serviceBo.getServiceWithDescription(license.getService().getDescription());
			
			if (service == null) {
				// Invalid service.
				return response(String.format("Invalid service description %s", license.getService().getDescription()), 
						Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
			} else {
				license.setService(service);
				license.setUser(user);
				user.addLicense(license);
				userBo.save(user);
				
				return okay(license);
			}
		}
	}
}
