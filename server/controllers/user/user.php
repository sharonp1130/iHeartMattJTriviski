<?php

require_once 'db/propel-bootstrap.php';

include 'utils/sanitize_phone.php';

use Base\UserQuery;


/**
 * @param  $username
 * @return ChildUser
 */
function get_user($username) {
	return UserQuery::create()
		->findOneByUsername($userName);
}

/**
 * Same as get user but throws an exception if the user name was not found.
 * 
 * @param unknown $username
 * @throws Exception
 * @return ChildUser
 */
function get_user_with_error($username) {
	$user = get_user($username);
	if ($user == null) {
		throw new Exception("User not found: username=" . $username);
	} else {
		return $user;
	}
}

/**
 * Throws 
 * @param unknown $username
 * @param unknown $isProvider
 * @param unknown $firstName
 * @param unknown $lastName
 * @param unknown $address
 * @param unknown $phoneNumber
 * @param unknown $email
 * @param string $suffix
 * @throws Exception if phone number is not correct and an sql exceptin if the username already exists.
 * @return User
 */
function create_user_and_get($username, $isProvider, $firstName, $lastName, $address, $phoneNumber, $email, $suffix=null) {
	
	$phone = sanitize_phone($phoneNumber);
	
	if ($phone) {
		$user = new User();
		$user->setIsprovider($isProvider ? 1 : 0);
		$user->setUsername($username);
		$user->setFirstname($firstName);
		$user->setLastname($lastName);
		$user->setSuffix($suffix);
		$user->setAddress($address);
		$user->setPhonenumber($phone);
		$user->setEmail($email);
		
		/**
		 * If the user name exists this will throw an exception.
		 */
		$user->save();
		
		return $user;
	} else {
		throw new Exception("Phone number is not compatible: " . $phoneNumber);
	}
}

/**
 * Updates user with the provided information.  Only updates values that are not null.
 * 
 * @param unknown $username
 * @param string $isProvider
 * @param string $firstName
 * @param string $lastName
 * @param string $address
 * @param string $phoneNumber
 * @param string $email
 * @param string $suffix
 * @return User after update.
 * 
 */
function update_user_and_get($username, $isProvider=null, $firstName=null, $lastName=null, 
		$address=null, $phoneNumber=null, $email=null, $suffix=null) {
	$user = get_user_with_error($username);
	
	if ($isProvider) {
		$user->setIsprovider($isProvider);
	}
	
	if ($firstName) {
		$user->setFirstname($firstName);
	}
	
	if ($lastName) {
		$user->setLastname($lastName);
	}
	
	if ($address) {
		$user->setAddress($address);
	}
	
	if ($phoneNumber) {
		$pn = sanitize_phone($phoneNumber);

		if ($ph) {
			$user->setPhonenumber($pn);
		}
	}
	
	if ($email) {
		$user->setEmail($email);
	}
	
	if ($suffix) {
		$user->setSuffix($suffix);
	}
	
	$user->save();
	return $user;
}

function check_in_location($username, $longitude, $latitude) {
	
}

/**
 * @param unknown $username
 * @param unknown $licenseNumber
 * @param unknown $serviceDescription
 * @return boolean If the license was added.
 */
function add_license($username, $licenseNumber, $serviceDescription) {
	$user = get_user_with_error($username);
	$user = new User();
	
	foreach ($user->getLicensesJoinService() as $lic) {
		if ($lic->getLicensenumber() == $licenseNumber) {
			print "Licens number has already been added to user: User:[" . $user . "] license::[" . $lic . "]"; 
			return false;
		}		
	}
	
	/**
	 * If we get here this is a new license and we want to add it.  Add a new license
	 */
	$service = ServiceQuery::create()->findByDescription($serviceDescription);
	$license = new License();
	$license->setService($service);
	
	
	
	$user->addLicense($license);
	
	return true;
}

function add_settings() {
	
}

function update_settings() {
	
}




?>