
package help.me.orm.entity;

import static org.junit.Assert.*;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.bo.impl.LicenseBoImpl;
import help.me.orm.bo.impl.UserBoImpl;

@ContextConfiguration(locations="classpath:config/BeanLocations.xml")
@RunWith(SpringJUnit4ClassRunner.class)
public class LicenseTest {
	
	@Autowired
	LicenseBoImpl bo;
	
	@Autowired
	UserBoImpl ubo;

	public Service createService(String des) {
		Service s = new Service();
		s.setDescription(des);
		
		return s;
	}
	
	public User createUser(String email) {
		User u = new User();
		u.setEmail(email);
		return u;
	}
	
	@Transactional
	@Test
	public void testLicense() { 
		User u = createUser("mmm.ttt@gmail.com");
		
		ubo.save(u);
		
		Service plumb = createService("plubming");
		Service elec = createService("electrical");
		
		License plumbL = new License();
		plumbL.setLicenseNumber("PLUMB123");
		plumbL.setService(plumb);
		plumbL.setUser(u);

		License electL = new License();
		electL.setLicenseNumber("ELEC456");
		electL.setService(elec);
		electL.setUser(u);
		
		bo.save(plumbL);
		bo.save(electL);

		License p = bo.findById(plumbL.getLicenseId());
		License e = bo.findById(electL.getLicenseId());

		assertEquals(plumbL, p);
		assertEquals(plumbL.getService(), p.getService());
		
		assertEquals(electL, e);
		assertEquals(electL.getService(), e.getService());

	}
	
}
