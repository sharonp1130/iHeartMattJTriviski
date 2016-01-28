package help.me.orm.entity;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.IOException;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;
import org.springframework.transaction.annotation.Transactional;

import help.me.boot.WebBoot;
import help.me.orm.bo.IServiceBo;
import junit.framework.TestCase;

@ContextConfiguration(classes=WebBoot.class)
@RunWith(SpringJUnit4ClassRunner.class)
public class ServiceTest extends TestCase {
	
	@Autowired
	private IServiceBo serviceBo;
	
	private File initFile = new File("/Users/triviski/help-me/help-me-spring/src/main/resources/img/service_init.csv");
	@Test
	@Transactional
	public void testInitService() throws FileNotFoundException, IOException {
		serviceBo.initializeFromFile(initFile);
	}
}
