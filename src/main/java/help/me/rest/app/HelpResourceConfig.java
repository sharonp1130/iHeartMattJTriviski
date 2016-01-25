package help.me.rest.app;

import javax.ws.rs.ApplicationPath;

import org.glassfish.jersey.server.ResourceConfig;
import org.glassfish.jersey.server.spring.scope.RequestContextFilter;
import org.springframework.stereotype.Component;

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
	
	public HelpResourceConfig() {
		super();
	    /**
	     * Register JAX-RS application components.
	     */
		setApplicationName("Help Me Server");
		packages(RESOURCE_PACKAGES);
		register(RequestContextFilter.class);
	}
}
