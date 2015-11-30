package help.me.orm.entity;

import static org.junit.Assert.assertEquals;

import java.io.OutputStream;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.bo.impl.LocationBoImpl;
import help.me.orm.bo.impl.UserBoImpl;

@ContextConfiguration(locations="classpath:config/BeanLocations.xml")
@RunWith(SpringJUnit4ClassRunner.class)
public class UserTest {
	
	@Autowired
	LocationBoImpl bo;
	
	@Autowired
	UserBoImpl ubo;

	@Transactional
	@Test
	public void testLicense() { 
		User user = new User();
		user.setEmail("mm.tt@gmail.com");
		
		ubo.save(user);
		
		User u = ubo.findById(user.getUserId());
//		User ue = ubo.findByEmail(user.getEmail());
		
		assertEquals(user, u);
		
//		assertEquals(user, ue);
//		assertEquals(u, ue);
		System.out.println(user.getCreatedAt() + "  " + user.getUpdatedAt());
		System.out.println(user);
		System.out.println(u);
		
	}
	
}
