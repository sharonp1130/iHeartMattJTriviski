package help.me.rest.resources;

import java.util.HashMap;

import javax.ws.rs.Consumes;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.Response.Status;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.bo.ILocationBo;
import help.me.orm.bo.IUserBo;
import help.me.orm.entity.Location;
import help.me.orm.entity.User;

/**
 * Resource for the provider to check in their location.
 * 
 * @author triviski
 *
 */
@Component
@Scope(value="request")
@Path("location")
public class LocationResource extends BaseResource {
	
	@Autowired
	ILocationBo locationBo;
	
	@Autowired
	IUserBo userBo;
	
	/**
	 * Looks up the user and adds a new location.  Data is posted as a JSON.
	 * @param userId
	 * @param longitude
	 * @param latitude
	 * @return Okay response with the new location as the entity.
	 */
	@POST
	@Path("{userId : \\d+}/")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
	public Response checkIn(@PathParam("userId") int userId, HashMap<String, Double> locations) {
		Double longitude = locations.get("longitude");
		Double latitude = locations.get("latitude");
		
		User user = userBo.findById(userId);
		if (user == null) {
			return response(String.format("No user was found with userId %d", userId), Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
		} else if (longitude == null || latitude == null) {
			return response("Input JSON with keys 'longitude' and 'latitude' pointing to the FLOAT location", Status.BAD_REQUEST, MediaType.TEXT_PLAIN_TYPE);
		} else {
			Location loc = locationBo.addLocation(user, longitude, latitude);
			return okay(loc, MediaType.APPLICATION_JSON_TYPE);
		}
	}
}
