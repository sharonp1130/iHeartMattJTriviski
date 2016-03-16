package help.me.boot;

import org.apache.tomcat.util.descriptor.web.WebXml;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.EnableAutoConfiguration;
import org.springframework.context.ConfigurableApplicationContext;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.FilterType;
import org.springframework.context.annotation.PropertySource;

/**
 * Main method when running as an executable jar file.
 * 
 * @author triviski
 *
 */
@Configuration
@ComponentScan(basePackages = "help.me", excludeFilters = @ComponentScan.Filter(type = FilterType.ASSIGNABLE_TYPE, classes = {
		SpringBootMainTomcat.class, WebXml.class }) )
@EnableAutoConfiguration
@PropertySource("classpath:properties/application.properties")
public class SpringBootMain {
	public static void main(String[] args) {
		ConfigurableApplicationContext ctx = SpringApplication.run(SpringBootMain.class, args);
		ctx.registerShutdownHook();
	}
}