package help.me.rest.resources;

import java.util.Collection;
import java.util.List;

import javax.transaction.Transactional;
import javax.validation.constraints.NotNull;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import help.me.orm.entity.User;
import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;
import io.swagger.annotations.ApiParam;

/**
 * Query for providers based on description, coordinates and distance.
 * 
 * @author triviski
 *
 */
@Component
@Scope(value="request")
@Path("query")
@Api(value="Provider query resource.")
public class Query extends BaseResource {
	
	/**
	 * @param serviceDescription
	 * @param longitude
	 * @param latitude
	 * @param distance
	 * @param maxResults
	 * @param usersToSkip
	 * @return
	 */
	@GET
	@Path("service/{description}")
	@Produces(MediaType.APPLICATION_JSON)
	@Transactional
	@ApiOperation(value="Query service providers within a set distance",
		response=User.class,
		responseContainer="List")
	public Response findProvider(
			@ApiParam(value="The service description.  Must be a valid value") 
			@PathParam("description") String serviceDescription,
			@ApiParam(value="The current longitude", required=true) 
			@NotNull @QueryParam("longitude") Double longitude,
			@ApiParam(value="The current latitude", required=true) 
			@NotNull @QueryParam("latitude") Double latitude,
			@ApiParam(value="Allowable distance of user.", required=true) 
			@QueryParam("distance") double distance,
			@ApiParam(value="Max number of query results.  Zero or less means no limit", defaultValue="0") 
			@QueryParam("maxResults") int maxResults,
			@ApiParam(value="User ids to skip.  Currently each value must be added as a query param.  Future updates will allow for csv inputs.") 
			@QueryParam("usersToSkip") List<Integer> usersToSkip
			) {

		Collection<User> results = userBo.findProviders(serviceDescription, longitude, latitude, distance, maxResults, usersToSkip);
		
		return okay(results);
	}
}
