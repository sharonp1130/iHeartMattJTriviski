package help.me.rest.resources;

import java.util.Collection;

import javax.transaction.Transactional;
import javax.validation.constraints.NotNull;
import javax.websocket.server.PathParam;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import help.me.orm.entity.User;
import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;

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
	
	@GET
	@Path("service/{description}")
	@Produces(MediaType.APPLICATION_JSON)
	@Transactional
	@ApiOperation(value="Query service providers within a set distance",
		response=User.class,
		responseContainer="List")
	public Response findProvider(@PathParam("serviceDescription") String serviceDescription,
			@NotNull @QueryParam("longitued") double longitude,
			@NotNull @QueryParam("latitude") double latitude,
			@QueryParam("distance") double distance
			) {

		Collection<User> results = this.licenseBo.findProviders(serviceDescription, longitude, latitude, distance);
		return okay(results);
	}
}
