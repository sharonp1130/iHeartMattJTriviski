package help.me.rest.resources;

import java.io.File;
import java.io.InputStream;
import java.util.Collection;
import java.util.HashMap;
import java.util.Map;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;

import org.apache.commons.lang.exception.ExceptionUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;
import org.springframework.transaction.annotation.Transactional;

import com.fasterxml.jackson.core.JsonProcessingException;

import help.me.orm.bo.IServiceBo;
import help.me.orm.entity.Service;
import io.swagger.annotations.Api;
import io.swagger.annotations.ApiOperation;
import io.swagger.annotations.ApiResponse;
import io.swagger.annotations.ApiResponses;

/**
 * Resource for getthing the available resources. 
 * 
 * @author triviski
 *
 */
@Component
@Scope(value="request")
@Path("services")
@Api(value="Resource to find services or get icons related to a service.")
public class ServicesResource extends BaseResource {
	@Autowired
	IServiceBo serviceBo;
	
	/**
	 * Creates a streaming response setting the media type to octet stream and streaming the contents of the 
	 * file.  If there is an error returns an error response with media type text plain.
	 * 
	 * @param streamFile
	 * @return Okay response with media type as 
	 */
	protected Response streamFileResponse(final File streamFile) {
		try {
			return Response
					.ok(getStreamingOutput(streamFile), MediaType.APPLICATION_OCTET_STREAM_TYPE)
					.build();
		} catch (Exception e) {
			return serverError(ExceptionUtils.getRootCauseMessage(e), MediaType.TEXT_PLAIN_TYPE);
		}
	}
	
	/**
	 * @param streamFileName
	 * @return
	 */
	protected Response streamFileResponse(final String streamFileName) {
		return streamFileResponse(new File(streamFileName));
	}
	
	
	/**
	 * Finds all available services and returns them as a json.
	 * 
	 * @return
	 * @throws JsonProcessingException
	 */
	@GET
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
	@ApiOperation(value="Retrieves all services.", 
			response=String.class, 
			responseContainer="List")
	@ApiResponses(value={
			@ApiResponse(code=404, message="No services found")
	})
	public Response getServices() throws JsonProcessingException {
		Collection<Service> services = serviceBo.getServices();

		if (services.isEmpty()) {
			return notFound(("No services were found"));
		} else {
			return okay(services, MediaType.APPLICATION_JSON_TYPE);
		}
	}

	/**
	 * Finds all available services and returns them as a json.
	 * 
	 * @return
	 * @throws JsonProcessingException
	 */
	@GET
	@Path("descriptions")
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
	@ApiOperation(value="Retrieve a list of all available service descriptions", 
			response=String.class, 
			responseContainer="Map")
	@ApiResponses(value={
			@ApiResponse(code=404, message="No services found")
	})
	public Response getServiceDescriptions() throws JsonProcessingException {
		Collection<String> services = serviceBo.getServiceNames();

		if (services.isEmpty()) {
			return notFound(("No services were found"));
		} else {
			Map<String, Collection<String>> servs = new HashMap<String, Collection<String>>();
			servs.put("descriptions", services);
			
			return okay(servs, MediaType.APPLICATION_JSON_TYPE);
		}
	}

	
	/**
	 * Looks up the service based on the description.  If found, gets the icon file and 
	 * streams it back.
	 * 
	 * @param description
	 * @return Response with streaming output for icon file contents.
	 */
	@GET
	@Path("{description : [a-zA-Z]+}/icon")
	@Produces({MediaType.APPLICATION_OCTET_STREAM, MediaType.TEXT_PLAIN})
	@Transactional
	@ApiOperation(value="Get icon file for service.")
	@ApiResponses(value={@ApiResponse(code=500, message="Service icon not found or unexpected error.")})
	public Response getIcon(@PathParam("description") String description) {
		Service service = serviceBo.getServiceWithServiceName(description);
		
		if (service == null) {
			return notFound();
		} else {
			InputStream iconStream = getClass().getResourceAsStream(service.getIconFileName());
			
			if (iconStream == null) {
				return serverError("Icon file was not found for service" + description);
			} else {
				try {
					return Response
							.ok(getStreamingOutput(iconStream), MediaType.APPLICATION_OCTET_STREAM_TYPE)
							.build();
				} catch (Exception e) {
					return serverError(ExceptionUtils.getRootCauseMessage(e), MediaType.TEXT_PLAIN_TYPE);
				}
			}
		}
	}
}
