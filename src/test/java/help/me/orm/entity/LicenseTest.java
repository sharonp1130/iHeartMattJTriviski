package help.me.orm.entity;

import junit.framework.TestCase;

public class LicenseTest extends TestCase {
	License license;
	
	@Override
	public void setUp() {
		license = new License();
		Service service = new Service();
		service.setDescription("this is some service");
		license.setService(service);
	}

	public void testLicense() {
		license.setLicenseNumber("123ABC");
		
	}
}
