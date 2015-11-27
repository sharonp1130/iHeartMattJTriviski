package help.me.orm.entity;

import junit.framework.TestCase;

public class InfoTest extends TestCase {
	Info info;
	
	@Override
	public void setUp() {
		info = new Info();
	}
	
	public void testCity() {
		for (String city : new String[] 
				{
				"san diego78",
				"austi76n"
				}
		) {
			// fails.
	 		try {
	 			info.setCity(city);
				fail("City was bogus and passed: " + city);
			} catch (Exception e) {
				// all good.
			}
		}
		
		// valid addresses.
		for (String city : new String[] 
				{
				"perth",
				"st. paul"
				}
		) {
			// fails.
	 		try {
	 			info.setCity(city);
			} catch (Exception e) {
				fail("City was good but failed validation");
				// all good.
			}
		}
	}

	
	public void testZipcode() {
		for (String zipcode : new String[] 
				{
				"912",
				"910011",
				"91001s",
				"qq91001"
				}
		) {
			// fails.
	 		try {
	 			info.setZipcode(zipcode);
				fail("Email was bogus and passed: " + zipcode);
			} catch (Exception e) {
				// all good.
			}
		}
		
		// valid addresses.
		for (String zipcode : new String[] 
				{
					"91001",
					"91001-4234"
				}
		) {
			// fails.
	 		try {
	 			info.setZipcode(zipcode);
			} catch (Exception e) {
				fail("Email was good but failed validation");
				// all good.
			}
		}

		
	}

	
	
	public void testPhoneNumber() {
		for (String phoneNumber : new String[] 
				{
				"6661233333",
				"123-44444",
				"345-567-",
				"1-123-567-5555",
				"123-567-5555"
				}
		) {
			// fails.
	 		try {
	 			info.setPhoneNumber(phoneNumber);
				fail("Email was bogus and passed: " + phoneNumber);
			} catch (Exception e) {
				// all good.
			}
		}
		
		// valid addresses.
		for (String phoneNumber : new String[] 
				{
				"(123) 567-5555"
				}
		) {
			// fails.
	 		try {
	 			info.setPhoneNumber(phoneNumber);
			} catch (Exception e) {
				fail("Email was good but failed validation");
				// all good.
			}
		}

		
	}
}
