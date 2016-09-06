package help.me.rest.resources;

import java.text.SimpleDateFormat;
import java.util.Calendar;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;

/**
 * Simple resource to check to make sure the Jersey web resources are working.
 * 
 * @author triviski
 *
 */
@Component
@Scope(value="request")
@Path("/")
public class PingResource {
	@GET
	@Path("/ping")
	@Produces(MediaType.TEXT_PLAIN)
	public Response helloWorld() {
		return Response.ok(String.format("Pong! %s", new SimpleDateFormat("yyyy-MM-dd'T'HH:mm:ss").format(Calendar.getInstance().getTime()))).build();
	}

}
