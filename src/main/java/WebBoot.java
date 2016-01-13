
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.ApplicationContext;

/**
 * This is the spring boot class that will be found by Jetty and started.  
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
