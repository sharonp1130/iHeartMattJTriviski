package help.me.boot;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.ApplicationContext;

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
@SpringBootApplication
public class WebBoot {
    
    public static void main(String[] args) {
        ApplicationContext ctx = SpringApplication.run(WebBoot.class, args);
    }
}
