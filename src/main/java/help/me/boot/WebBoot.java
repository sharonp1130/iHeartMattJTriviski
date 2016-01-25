package help.me.boot;

import java.util.Properties;

import javax.sql.DataSource;

import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.context.annotation.PropertySource;
import org.springframework.core.env.Environment;
import org.springframework.jdbc.datasource.DriverManagerDataSource;
import org.springframework.orm.hibernate4.HibernateTransactionManager;
import org.springframework.orm.hibernate4.LocalSessionFactoryBean;

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
@SpringBootApplication(scanBasePackages="help.me")
@PropertySource(value = { "classpath:properties/application.properties" })
public class WebBoot {
	private static final String ENTITY_SCAN_PACKAGES = "help.me.orm";
	
	// JDBC required properties.
	private static final String JDBC_DRIVER_PROPERTY = "jdbc.driverClassName";
	private static final String JDBC_URL_PROPERTY = "jdbc.url";
	private static final String JDBC_USER_PROPERTY = "jdbc.username";
	private static final String JDBC_PASSWORD_PROPERTY = "jdbc.password";
	
	// Hibernate required properties.
	private static final String HIBERNATE_DIALECT_PROPERTY = "hibernate.dialect";
	private static final String HIBERNATE_SHOW_SQL_PROPERTY = "hibernate.show_sql";
	private static final String HIBERNATE_FORMAT_SQL_PROPERTY = "hibernate.format_sql";
	
    @Autowired
    private Environment environment;
 
    /**
     * @return
     */
    @Bean
    public LocalSessionFactoryBean sessionFactory() {
        LocalSessionFactoryBean sessionFactory = new LocalSessionFactoryBean();
        sessionFactory.setDataSource(dataSource());
        sessionFactory.setPackagesToScan(ENTITY_SCAN_PACKAGES);
        sessionFactory.setHibernateProperties(hibernateProperties());
        return sessionFactory;
     }
	
    /**
     * Bean configuration for the datasource which is the connection to the database.. 
     * 
     * @return
     */
    @Bean
    public DataSource dataSource() {
        DriverManagerDataSource dataSource = new DriverManagerDataSource();
        dataSource.setDriverClassName(environment.getRequiredProperty(JDBC_DRIVER_PROPERTY));
        dataSource.setUrl(environment.getRequiredProperty(JDBC_URL_PROPERTY));
        dataSource.setUsername(environment.getRequiredProperty(JDBC_USER_PROPERTY));
        dataSource.setPassword(environment.getRequiredProperty(JDBC_PASSWORD_PROPERTY));
        
        return dataSource;
    }
     
    /**
     * @param s
     * @return
     */
    @Bean
    @Autowired
    public HibernateTransactionManager transactionManager(SessionFactory s) {
       HibernateTransactionManager txManager = new HibernateTransactionManager();
       txManager.setSessionFactory(s);
       return txManager;
    }

    
    /**
     * Creates a hibernate properies deal balls.
     * @return
     */
    private Properties hibernateProperties() {
        Properties properties = new Properties();
        properties.put(HIBERNATE_DIALECT_PROPERTY, environment.getRequiredProperty(HIBERNATE_DIALECT_PROPERTY));
        properties.put(HIBERNATE_SHOW_SQL_PROPERTY, environment.getRequiredProperty(HIBERNATE_SHOW_SQL_PROPERTY));
        properties.put(HIBERNATE_FORMAT_SQL_PROPERTY, environment.getRequiredProperty(HIBERNATE_FORMAT_SQL_PROPERTY));
        
        if (environment.containsProperty("hibernate.hbm2ddl.auto")) {
        		properties.put("hibernate.hbm2ddl.auto", environment.getProperty("hibernate.format_sql"));
        }
        
        return properties;        
    }

	
    
    public static void main(String[] args) {
        SpringApplication.run(WebBoot.class, args);
    }
}
