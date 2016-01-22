package help.me.boot;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.ImportResource;

/**
 * This is the spring boot class that will be found by Jetty and started when 
 * using the mvn jetty:run.  
 * 
 * Not sure how to go for production, use jetty or tomcat and how to start.  Will
 * find out soon enough.
 * 
 * @author triviski
 *
 */
@Configuration
@SpringBootApplication
@ImportResource("config/BeanLocations.xml")
public class WebBoot {
    
    public static void main(String[] args) {
        SpringApplication.run(WebBoot.class, args);
    }
}
