//package help.me.configuration;
//
//import java.util.Properties;
//
//import javax.sql.DataSource;
//
//import org.hibernate.dialect.H2Dialect;
//import org.springframework.beans.factory.annotation.Value;
//import org.springframework.context.annotation.Bean;
//import org.springframework.context.annotation.Configuration;
//import org.springframework.orm.hibernate3.HibernateTransactionManager;
//import org.springframework.orm.hibernate4.LocalSessionFactoryBean;
//
//import help.me.orm.entity.Info;
//import help.me.orm.entity.License;
//import help.me.orm.entity.Location;
//import help.me.orm.entity.Service;
//import help.me.orm.entity.Settings;
//import help.me.orm.entity.User;
//
//@Configuration
//public class HibernateConfiguration {
//
//	@Value("#{dataSource}")
//	private DataSource dataSource;
//
//	@Bean
//	public LocalSessionFactoryBean sessionFactoryBean() {
//		Properties props = new Properties();
//		// TODO this is for test, needs to be updated at some point.
//		props.put("hibernate.dialect", H2Dialect.class.getName());
//		
//		props.put("hibernate.format_sql", "true");
//		props.put("hibernate.ddl-auto", "create");
//		props.put("hibernate.show_sql", "false");
//
//
//		LocalSessionFactoryBean bean = new LocalSessionFactoryBean();
//		bean.setAnnotatedClasses(new Class[]{
//				User.class,
//				Info.class,
//				Settings.class,
//				Service.class,
//				Location.class,
//				License.class
//				});		
//		
//		bean.setHibernateProperties(props);
//		bean.setDataSource(this.dataSource);
//		
//		return bean;
//	}
//
//	@Bean
//	public HibernateTransactionManager transactionManager() {
//		return new HibernateTransactionManager( sessionFactoryBean().getObject() );
//	}
//
//}
