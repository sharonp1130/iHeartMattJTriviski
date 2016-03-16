package help.me.boot;

import org.springframework.boot.autoconfigure.EnableAutoConfiguration;
import org.springframework.boot.context.web.SpringBootServletInitializer;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.FilterType;
import org.springframework.context.annotation.PropertySource;

import help.me.boot.beans.EmbeddedServerConfiguration;

/**
 * Bean configuration class.
 * 
 * @author triviski
 *
 */
@Configuration
@EnableAutoConfiguration
@ComponentScan(basePackages = "help.me", excludeFilters = @ComponentScan.Filter(type = FilterType.ASSIGNABLE_TYPE, classes = {
		SpringBootMain.class, EmbeddedServerConfiguration.class }) )
@PropertySource("classpath:properties/application.properties")
public class SpringBootMainTomcat extends SpringBootServletInitializer {
}
