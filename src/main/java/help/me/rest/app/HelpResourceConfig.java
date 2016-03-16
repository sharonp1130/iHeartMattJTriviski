package help.me.rest.app;

import java.io.IOException;

import javax.ws.rs.ApplicationPath;

import org.glassfish.jersey.server.ResourceConfig;
import org.glassfish.jersey.server.ServerProperties;
import org.springframework.stereotype.Component;

import help.me.rest.ObjectMapperProvider;
import help.me.rest.resources.LocationResource;
import help.me.rest.resources.PingResource;
import help.me.rest.resources.Query;
import help.me.rest.resources.ServicesResource;
import help.me.rest.resources.UserResource;
import io.swagger.jaxrs.listing.ApiListingResource;
import io.swagger.jaxrs.listing.SwaggerSerializers;

/**
 * Jersey application.
 * 
 * @author triviski
 *
 */
@Component
@ApplicationPath("api")
public class HelpResourceConfig extends ResourceConfig {
	
	public HelpResourceConfig() throws IOException {
		super();
	    /**
	     * Register JAX-RS application components.
	     */
		setApplicationName("Help Me Server");
		
		// Add the swagger classes.
		register(SwaggerSerializers.class);
        register(ApiListingResource.class);
        register(LocationResource.class);
        register(PingResource.class);
        register(Query.class);
        register(ServicesResource.class);
        register(UserResource.class);
        register(ObjectMapperProvider.class);
        property(ServerProperties.MOXY_JSON_FEATURE_DISABLE, true);
        
        setApplicationName("HelpMeBackendServer");

	}
}
