package help.me.rest;

import javax.ws.rs.ext.ContextResolver;
import javax.ws.rs.ext.Provider;

import com.fasterxml.jackson.databind.ObjectMapper;

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
	
	public ObjectMapperProvider() {
		mapper = JsonUtilities.createRequestObjectMapper();
	}
	
	   /**
	    * Expected to only be used for results.  
	    * 
	    * @see javax.ws.rs.ext.ContextResolver#getContext(java.lang.Class)
	    */
	   @Override
	   public ObjectMapper getContext(final Class<?> type) {
		   return mapper;
	   }
}
