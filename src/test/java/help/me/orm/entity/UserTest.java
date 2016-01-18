package help.me.orm.entity;

import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertTrue;

import java.io.IOException;
import java.sql.Time;
import java.util.Arrays;

import org.junit.Before;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.transaction.annotation.Transactional;

import com.fasterxml.jackson.core.JsonGenerationException;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.JsonMappingException;

import help.me.json.utilities.JsonUtilities;
import help.me.orm.bo.impl.InfoBoImpl;
import help.me.orm.bo.impl.LicenseBoImpl;
import help.me.orm.bo.impl.LocationBoImpl;
import help.me.orm.bo.impl.SettingsBoImpl;
import help.me.orm.bo.impl.UserBoImpl;
import help.me.orm.dao.impl.ServiceDaoImpl;

@ContextConfiguration(locations="classpath:config/BeanLocations.xml")
@RunWith(SpringJUnit4ClassRunner.class)
public class UserTest {
	@Autowired
	LocationBoImpl lbo;
	
	@Autowired
	UserBoImpl ubo;

	@Autowired
	LicenseBoImpl licbo;
	
	@Autowired
	ServiceDaoImpl serv;
	
	@Autowired
	InfoBoImpl ibo;
	
	@Autowired
	SettingsBoImpl setbo;
	
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
		
		setServices();
	}
	
	public void setServices() {
		for(String desc : Arrays.asList("plumbing", "electrical", "roofing")) {
			Service s = new Service();
			s.setDescription(desc);
			serv.save(s);
		}
	}
	
	public Location addLocation(User user, double longitude, double latitude) {
		Location loc = lbo.addLocation(user, longitude, latitude);
		lbo.saveOrUpdate(loc);
		
		return loc;
	}

	@Transactional
	@Test
	public void testLicense() throws JsonGenerationException, JsonMappingException, IOException {
		String ln = "balls";
		License plum = ubo.addLicense(user, ln, "plumbing");
		
		assertEquals(plum.getService().getDescription(), "plumbing");
		assertEquals(plum.getLicenseNumber(), "balls");
		
		assertEquals(plum, user.getLicenses().iterator().next());
		
		License elec = ubo.addLicense(user, "electrical", "electrical");
		License roof = ubo.addLicense(user, "roofing", "roofing");

		assertTrue(user.getLicenses().contains(plum));
		assertTrue(user.getLicenses().contains(elec));
		assertTrue(user.getLicenses().contains(roof));
		
		System.out.println(JsonUtilities.getRequestMapper().writeValueAsString(user.getLicenses()));

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

	@Transactional
	@Test
	public void testInfo() throws JsonGenerationException, JsonMappingException, IOException {
		Info info = new Info();
		info.setAddress("some address");
		info.setBusinessName("my business");
		info.setCity("st. paul");
		info.setPhoneNumber("(818) 112-1345");
		info.setZipcode("12345");
		info.setUser(user);
		ibo.saveOrUpdate(info);
		
		user.setInfo(info);
		ubo.saveOrUpdate(user);
		
		assertEquals(info, user.getInfo());
		assertEquals(info.getUser(), user);
		
		System.out.println(JsonUtilities.getRequestMapper().writeValueAsString(user.getInfo()));
	}
	
	@Transactional
	@Test
	public void testSettings() throws JsonGenerationException, JsonMappingException, IOException {
		Settings setting = new Settings();
		@SuppressWarnings("deprecation")
		Time t = new Time(1,2,3);
		setting.setMondayStart(t);
		user.setSettings(setting);
		ubo.saveOrUpdate(user);
		System.out.println(user);
		System.out.println(JsonUtilities.getRequestMapper().writeValueAsString(user.getSettings()));
	}
	
	@Transactional
	@Test
	public void testUser() throws JsonProcessingException {
		ubo.saveOrUpdate(user);
		user.setEmail("someoher@fff.com");
		ubo.saveOrUpdate(user);
		System.out.println(JsonUtilities.getRequestMapper().writeValueAsString(user));
	}
}
