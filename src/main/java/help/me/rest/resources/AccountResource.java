package help.me.rest.resources;

import java.util.Set;

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
import help.me.orm.entity.Settings;
import help.me.orm.entity.User;

/**
 * Jersey resource class for account information.  
 * 
 * This is used to look up account information, add an account, 
 * update and delete.  Basically, all the account stuff balls.
 * 
 * @author triviski
 *
 */
@Component
@Scope(value="request")
@Path("account")
public class AccountResource extends BaseResource {
	
	@GET
	@Path("/helloworld")
	@Produces(MediaType.TEXT_PLAIN)
	public Response helloWorld(@QueryParam("name") String name) {
		return Response.ok(String.format("Hello %s!", name == null ? "no name" : name)).build();
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
	public Response checkUserAccount(@QueryParam("email") String email) {
		
		
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
	@Path("/{userId : \\d+}/settings")
	@Produces(MediaType.APPLICATION_JSON)
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
	@Path("/{userId : \\d+}/license")
	@Produces(MediaType.APPLICATION_JSON)
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
	@Path("/user/{userId : \\d+}")
	@Produces(MediaType.TEXT_PLAIN)
	@Transactional
	public Response deleteUser(@PathParam("userId") int userId) {
		User user = userBo.findById(userId);
		
		if (user == null) {
			return serverError(String.format("No user found for userId %d", userId));
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
	@Path("/user/{userId : \\d+}")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
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
	@Path("/user")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.APPLICATION_JSON)
	@Transactional
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
	@Path("/user/{userId : \\d+}/info")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
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
	@Path("/user/{userId : \\d+}/availability")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
	public Response addOrUpdateSettings(@PathParam("userId") int userId, Settings settings) {
		User user = userBo.findById(userId);
		
		if (user == null) {
			return response(String.format("No user was found with userId %d", userId), Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
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
}
