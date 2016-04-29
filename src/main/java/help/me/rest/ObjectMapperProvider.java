package help.me.rest;

import javax.ws.rs.ext.ContextResolver;
import javax.ws.rs.ext.Provider;

import com.fasterxml.jackson.databind.ObjectMapper;

import help.me.rest.resources.Query.UserQueryResults;
import help.me.utilities.json.JsonUtilities;

/**
 * Object mapper provider for Jersey used for responses that get back the 
 * hibernate entity objects that have been wired up for Jackson.
 * 
 * @author triviski
 *
 */
@Provider
public class ObjectMapperProvider implements ContextResolver<ObjectMapper> {
	private ObjectMapper mapper;
	private ObjectMapper userMapper;
	
	public ObjectMapperProvider() {
		mapper = JsonUtilities.createRequestObjectMapper();
		userMapper = JsonUtilities.createUserObjectMapper();
	}
	
	   /**
	    * Expected to only be used for results.  
	    * 
	    * @see javax.ws.rs.ext.ContextResolver#getContext(java.lang.Class)
	    */
	   @Override
	   public ObjectMapper getContext(final Class<?> type) {
		   /**
		    * Query results will be stored in a special list class in order to 
		    * identify when the user object mapper needs to be used.
		    */
		   if (type.equals(UserQueryResults.class)) {
			   return userMapper;
		   } else {
			   return mapper;
		   }
	   }
}
