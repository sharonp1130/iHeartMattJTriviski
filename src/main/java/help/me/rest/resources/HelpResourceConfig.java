package help.me.rest.resources;

import org.glassfish.jersey.server.ResourceConfig;
import org.glassfish.jersey.server.spring.scope.RequestContextFilter;

/**
 * Jersey application.
 * 
 * @author triviski
 *
 */
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
