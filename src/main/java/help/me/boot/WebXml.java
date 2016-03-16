package help.me.boot;

import org.springframework.boot.builder.SpringApplicationBuilder;
import org.springframework.boot.context.web.SpringBootServletInitializer;
import org.springframework.context.annotation.Configuration;

/**
 * This class is used to start the Spring boot auto configuration when being started 
 * in a Tomcat server.   
 * 
 * @author triviski
 *
 */
@Configuration
public class WebXml extends SpringBootServletInitializer {

    /** 
     * {@inheritDoc}
     */
    @Override
    protected SpringApplicationBuilder configure(SpringApplicationBuilder builder) {
        return builder.sources(SpringBootMainTomcat.class);
    }   
}
