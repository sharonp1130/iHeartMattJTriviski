package help.me.rest.resources;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

import help.me.orm.bo.IUserBo;

/**
 * Jersey resource class for account information.
 * 
 * @author triviski
 *
 */
@Component
@Scope(value="request")
@Path("account")
public class AccountResource {
	@Autowired
	IUserBo ubo;
	
	@GET
	@Path("/helloworld")
	@Produces(MediaType.TEXT_PLAIN)
	public Response helloWorld(@QueryParam("name") String name) {
		return Response.ok(String.format("Hello %s!", name == null ? "no name" : name)).build();
	}
}
