
package help.me.orm.entity;

import static org.junit.Assert.assertEquals;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.transaction.annotation.Transactional;

import com.fasterxml.jackson.core.JsonProcessingException;

import help.me.boot.SpringBootMain;
import help.me.orm.bo.impl.LicenseBoImpl;
import help.me.orm.bo.impl.UserBoImpl;
import help.me.utilities.json.JsonUtilities;

@ContextConfiguration(classes=SpringBootMain.class)
@RunWith(SpringJUnit4ClassRunner.class)
public class LicenseTest {
	
	@Autowired
	LicenseBoImpl bo;
	
	@Autowired
	UserBoImpl ubo;

	public Service createService(String des) {
		Service s = new Service();
		s.setServiceName(des);
		
		return s;
	}
	
	public User createUser(String email) {
		User u = new User();
		u.setEmail(email);
		return u;
	}
	
	@Transactional
	@Test
	public void testLicense() throws JsonProcessingException { 
		User u = createUser("mmm.ttt@gmail.com");
		
		ubo.save(u);
		
		Service plumb = createService("plubming");
		Service elec = createService("electrical");
		
		License plumbL = new License();
		plumbL.setLicenseNumber("PLUMB123");
		plumbL.setService(plumb);
		plumbL.setUser(u);
		u.addLicense(plumbL);

		License electL = new License();
		electL.setLicenseNumber("ELEC456");
		electL.setService(elec);
		electL.setUser(u);
		
		u.addLicense(electL);
		bo.save(plumbL);
		bo.save(electL);

		License p = bo.findById(plumbL.getLicenseId());
		License e = bo.findById(electL.getLicenseId());

		assertEquals(plumbL, p);
		assertEquals(plumbL.getService(), p.getService());
		
		assertEquals(electL, e);
		assertEquals(electL.getService(), e.getService());
		
		System.out.println(JsonUtilities.getRequestMapper().writeValueAsString(u.getLicenses()));

	}
	
}
