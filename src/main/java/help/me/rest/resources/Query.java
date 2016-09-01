package help.me.rest.resources;

import java.io.IOException;
import java.io.OutputStream;
import java.util.Arrays;
import java.util.Collection;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Map.Entry;
import java.util.TreeSet;

import javax.validation.constraints.NotNull;
import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.QueryParam;
import javax.ws.rs.WebApplicationException;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.StreamingOutput;

import org.apache.commons.lang.StringUtils;
import org.hibernate.Criteria;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Scope;
import org.springframework.stereotype.Component;
import org.springframework.transaction.annotation.Transactional;

import com.fasterxml.jackson.core.JsonGenerator;
import com.fasterxml.jackson.databind.ObjectMapper;

import help.me.orm.entity.User;
import help.me.utilities.ConvertUtils;
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

	@Autowired
	ObjectMapper userMapper;
	
	
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
	@Produces(MediaType.APPLICATION_OCTET_STREAM)
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
			@ApiParam(value="Allowable distance of user in miles.", required=true) 
			@NotNull @QueryParam("distance") Double distance,
			@ApiParam(value="Max number of query results.  Zero or less means the system limit will be used.", defaultValue="0") 
			@QueryParam("maxResults") int maxResults,
			@ApiParam(value="User ids to skip.  This should be a csv with single user IDS and/or number ranges.  Example: 1,2,3,7..12.") 
			@QueryParam("usersToSkip") List<String> usersToSkip
			) {

		Collection<Integer> skips = new TreeSet<Integer>();
		
		for (String chunk : usersToSkip) {
			skips.addAll(ConvertUtils.convertRangeInt(Arrays.asList(StringUtils.split(chunk, ","))));
		}

		return streamQueryResults(userBo.findProviders(serviceDescription, longitude, latitude, distance, maxResults, skips));
	}
	
	@GET
	@Path("{count}")
	@Produces(MediaType.APPLICATION_OCTET_STREAM)
	@Transactional
	public Response giveMeSome(
			@PathParam("count") int count
			) {
		final Map<Double, User> dm = new HashMap<Double, User>();
		
		double distance = 1.1;
		List<?> results = userBo.getDao().getCurrentSession().createCriteria(User.class).setResultTransformer(Criteria.DISTINCT_ROOT_ENTITY).list();
		for (Object user : results) {
			dm.put(distance, (User) user);
			distance += 0.1;
		}
				
		return streamQueryResults(dm);
	}
	
	/**
	 * Streams the query results from the result map.  Adds the distance to the user.
	 * 
	 * @param results
	 * @return streaming response.
	 */
	public Response streamQueryResults(final Map<Double, User> results) {
		StreamingOutput stream = new StreamingOutput() {
			
			@Override
			public void write(OutputStream output) throws IOException, WebApplicationException {
				JsonGenerator generator = userMapper
						.getFactory()
						.createGenerator(output);
				
				generator.useDefaultPrettyPrinter();

				generator.writeStartArray();
				for (Entry<Double, User> es : results.entrySet()) {
					double distance = es.getKey();
					User user = es.getValue();
					
					user.setDistance(distance);
					generator.writeObject(user);
				}

				generator.writeEndArray();
				generator.flush();
			}
		};

		return okay(stream);
	}
}
