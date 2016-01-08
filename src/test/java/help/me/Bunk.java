package help.me;

import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertTrue;
import static org.junit.Assert.fail;

import java.util.Arrays;
import java.util.Set;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.bo.impl.InfoBoImpl;
import help.me.orm.bo.impl.LicenseBoImpl;
import help.me.orm.bo.impl.LocationBoImpl;
import help.me.orm.bo.impl.UserBoImpl;
import help.me.orm.dao.impl.ServiceDaoImpl;
import help.me.orm.entity.License;
import help.me.orm.entity.Location;
//import help.me.orm.entity.Service;
import help.me.orm.entity.User;

@Service("bunk")
public class Bunk {
	@Autowired
	ServiceDaoImpl sdao;

	@Autowired
	InfoBoImpl ibo;

	@Autowired
	LocationBoImpl lbo;
	
	@Autowired
	UserBoImpl ubo;

	@Autowired
	LicenseBoImpl licbo;
	
	@Autowired
	ServiceDaoImpl serv;
	

	@Transactional
	public void ballss() {
		User user = ubo.findByEmail("balls@gmail.com");
		
		if (user == null) {
			user = new User();
		}
		user.setEmail("balls@gmail.com");
		user.setFirstName("matt");
		user.setLastName("elias");
		user.setIsProvider(true);
		ubo.save(user);
		
		
		System.out.println(user);
	}
	
	User user;
	String email = "balls@gmail.com";

	public void doSetUp() {
		user = ubo.findByEmail(email);
		
		if (user == null) {
			user = new User();
			user.setEmail(email);
			user.setFirstName("matt");
			user.setLastName("elias");
			user.setIsProvider(true);
			ubo.saveOrUpdate(user);
			setServices();
		}
		
	}
	
	public void setServices() {
		for(String desc : Arrays.asList("plumbing", "electrical", "roofing")) {
			help.me.orm.entity.Service s = new help.me.orm.entity.Service();
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
	public void balls() {
		doSetUp();
		System.out.println(user);
		
		String ln = "balls";
		ubo.addLicense(user, ln, "plumbing");
		ubo.saveOrUpdate(user);
		licbo.createNewLicense(ln, user, "plumbing");
//		user.addLicense(plum);
		
		System.out.println(user);
//		assertEquals(plum.getService().getDescription(), "plumbing");
//		assertEquals(plum.getLicenseNumber(), "balls");
//		User uu = plum.getUser();
//		User uuu = ubo.findByEmailOrCreate(email);
//		Set<License> l = user.getLicenses();
//		
//		assertEquals(plum, user.getLicenses().iterator().next());
//		
//		try {
//			licbo.createNewLicense(ln, user, "plumbing");
//			fail("Should have failed adding the same deal");
//		} catch (Exception e) {
//			// should fail
//		}
//
//		License elec = licbo.createNewLicense(ln, user, "electrical");
//		License roof = licbo.createNewLicense(ln, user, "roofing");
//
//		assertTrue(user.getLicenses().contains(plum));
//		assertTrue(user.getLicenses().contains(elec));
//		assertTrue(user.getLicenses().contains(roof));
	}
}
