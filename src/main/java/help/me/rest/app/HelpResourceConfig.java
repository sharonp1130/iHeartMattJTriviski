package help.me.rest.app;

import java.io.IOException;

import javax.ws.rs.ApplicationPath;

import org.glassfish.jersey.server.ResourceConfig;
import org.springframework.stereotype.Component;

import io.swagger.jaxrs.config.BeanConfig;
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
	private static final String RESOURCE_PACKAGES = "help.me.rest";
	
	public HelpResourceConfig() throws IOException {
		super();
	    /**
	     * Register JAX-RS application components.
	     */
		setApplicationName("Help Me Server");
		packages(RESOURCE_PACKAGES);
		//this.register(RequestContextFilter.class);
		
		// Add the swagger classes.
		register(SwaggerSerializers.class);
        register(ApiListingResource.class);

        BeanConfig beanConfig = new BeanConfig();
        beanConfig.setVersion("1.0.2");
        beanConfig.setSchemes(new String[]{"http"});
        beanConfig.setHost("localhost:8080");
        beanConfig.setBasePath("/api");
        beanConfig.setResourcePackage("help.me.rest.resources");
        beanConfig.setPrettyPrint(true);
        beanConfig.setScan(true);
	}
}
