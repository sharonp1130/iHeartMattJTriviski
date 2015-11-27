package help.me.orm.entity;

import org.apache.commons.validator.ValidatorException;

import junit.framework.TestCase;

public class EntityTest extends TestCase {
	User user;
	public void setUp() {
		user = new User();
	}
	
	public void testUserSettings() {
		
	}
	
	public void testUser() {
		
	}
	
	
	public void testEmail() {

		for (String address : new String[] 
				{
				"bogusaddress",
				"1234abcd@balls",
				"@hurp.edu"
				}
		) {
			// fails.
	 		try {
				user.setEmail(address);
				fail("Email was bogus and passed: " + address);
			} catch (ValidatorException e) {
				// all good.
			}
		}
		
		// valid addresses.
		for (String address : new String[] 
				{
				"abcd@gmail.com",
				"hurp1234@xyx.uk"
				}
		) {
			// fails.
	 		try {
				user.setEmail(address);
			} catch (ValidatorException e) {
				fail("Email was good but failed validation");
				// all good.
			}
		}
	}
}
