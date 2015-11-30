package help.me.orm.entity;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.transaction.annotation.Transactional;

import help.me.orm.dao.impl.ServiceDaoImpl;
import junit.framework.TestCase;

@ContextConfiguration(locations="classpath:config/BeanLocations.xml")
@RunWith(SpringJUnit4ClassRunner.class)
public class ServiceTest extends TestCase {
	@Autowired
	private ServiceDaoImpl dao;
	
	@Test
	@Transactional
	public void testService() {
		Service s = new Service();
		s.setDescription("Plubming");
		s.setServiceId(1234);
		dao.save(s);
	}
}
