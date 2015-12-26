package help.me.orm.entity;

import static org.junit.Assert.assertEquals;

import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.datasource.embedded.EmbeddedDatabase;
import org.springframework.jdbc.datasource.embedded.EmbeddedDatabaseBuilder;
import org.springframework.jdbc.datasource.embedded.EmbeddedDatabaseType;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.bo.impl.LocationBoImpl;
import help.me.orm.bo.impl.UserBoImpl;
import help.me.orm.dao.impl.UserDaoImpl;

@ContextConfiguration(locations="classpath:config/BeanLocations.xml")
@RunWith(SpringJUnit4ClassRunner.class)
public class UserTest {
	@Autowired
	LocationBoImpl lbo;
	
	@Autowired
	UserBoImpl ubo;

	User user;
	String email = "balls@gmail.com";

	@Before
	public void setUp() {
		user = ubo.findByEmail(email);
		
		if (user == null) {
			user = new User();
			user.setEmail(email);
			user.setFirstName("matt");
			user.setLastName("elias");
			user.setIsProvider(true);
			ubo.saveOrUpdate(user);
		}
	}
	
	public Location addLocation(User user, double longitude, double latitude) {
		Location loc = lbo.addLocation(user, longitude, latitude);
		lbo.saveOrUpdate(loc);
		
		return loc;
	}
	
	@Transactional
	@Test
	public void testLocation() {
		double max = 20;
		for (double ll = max; ll > 1; ll--) {
			addLocation(user, ll, ll);
		}
		
		Location uloc = lbo.getLastLocation(user);
		Location eloc = lbo.getLastLocation(email);
		
		assertEquals((long)uloc.getLongitude(), (long)eloc.getLongitude());
		assertEquals((long)uloc.getLatitude(), (long)eloc.getLatitude());
		assertEquals("", (long)uloc.getLatitude(), (long)max);
		assertEquals("", (long)uloc.getLongitude(), (long)max);
		assertEquals("", (long)eloc.getLatitude(), (long)max);
		assertEquals("", (long)eloc.getLongitude(), (long)max);
		
	}
	
//	@Transactional
//	@Test
//	public void testLicense() { 
//		User user = new User();
//		user.setEmail("mm.tt@gmail.com");
//		
//		ubo.save(user);
//		System.out.println(ubo);
//		User u = ubo.findById(user.getUserId());
////		User ue = ubo.findByEmail(user.getEmail());
//		
//		assertEquals(user, u);
//		
////		assertEquals(user, ue);
////		assertEquals(u, ue);
//		System.out.println(user.getCreatedAt() + "  " + user.getUpdatedAt());
//		System.out.println(user);
//		System.out.println(u);
//		
//	}
	
}
