package help.me.rest.resources;

import java.io.File;
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

/**
 * Resource for getthing the available resources. 
 * 
 * @author triviski
 *
 */
@Component
@Scope(value="request")
@Path("services")
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
	@Path("descriptions")
	@Produces({MediaType.APPLICATION_JSON, MediaType.TEXT_PLAIN})
	@Transactional
	public Response getServices() throws JsonProcessingException {
		Collection<String> services = serviceBo.getServiceDescriptions();

		if (services.isEmpty()) {
			return notFound(("No services were found"));
		} else {
			Map<String, Collection<String>> servs = new HashMap<String, Collection<String>>();
			servs.put("descriptions", services);
			
//			return okay(JsonUtilities.getRequestMapper().writeValueAsString(servs), MediaType.APPLICATION_JSON_TYPE);
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
	public Response getIcon(@PathParam("description") String description) {
		Service service = serviceBo.getServiceWithDescription(description);
		
		if (service == null) {
			return notFound();
		} else {
			return streamFileResponse(service.getIconFileName());
		}
	}
}
