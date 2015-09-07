<?php

require_once 'db/propel-bootstrap.php';

include 'utils/sanitize_phone.php';

use Base\UserQuery;
use Base\UsersettingsQuery;
use Propel\Runtime\Map\TableMap;
use Base\User;
use Map\UserTableMap;


/**
 * @param  $email
 * @return ChildUser
 */
function get_user($email) {
	return UserQuery::create()
		->findOneByEmail($email);
}

/**
 * Same as get user but throws an exception if the user name was not found.
 * 
 * @param unknown $email
 * @throws Exception
 * @return ChildUser
 */
function get_user_with_error($email) {
	$user = get_user($email);
	if ($user == null) {
		throw new Exception("User not found for email address " . $email);
	} else {
		return $user;
	}
}

/**
 * @param unknown $email
 * @param unknown $isProvider
 * @param unknown $firstName
 * @param unknown $lastName
 * @param unknown $address
 * @param unknown $city
 * @param unknown $zip
 * @param unknown $phoneNumber
 * @param string $suffix
 * @throws Exception if phone number is not correct, zip is not in the right format or the email is already taken.
 * @return User
 */
function create_user_and_get($email, $isProvider, $firstName, $lastName, $address, $city, $zip, $phoneNumber, $suffix=null) {
	
	$phone = sanitize_phone($phoneNumber);
	
	if ($phone) {
		$user = new User();
		$user->setEmail($email);
		$user->setIsprovider($isProvider ? 1 : 0);
		$user->setFirstname($firstName);
		$user->setLastname($lastName);
		$user->setSuffix($suffix);
		$user->setAddress($address);
		$user->setCity($city);
		$user->setZipcode(filter_var($zip, FILTER_SANITIZE_NUMBER_INT));
		$user->setPhonenumber($phone);
		
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
 * @param unknown $email
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
function update_user_and_get($email, $isProvider=null, $firstName=null, $lastName=null, 
		$address=null, $city=null, $zip=null, $phoneNumber=null, $suffix=null) {
	$user = get_user_with_error($email);
	
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
	
	if ($city) {
		$user->setCity($city);
	}
	
	if ($zip) {
		$user->setZipcode($zip);
	}
	
	if ($phoneNumber) {
		$pn = sanitize_phone($phoneNumber);

		if ($ph) {
			$user->setPhonenumber($pn);
		}
	}
	
	if ($suffix) {
		$user->setSuffix($suffix);
	}
	
	$user->save();
	return $user;
}

/**
 * @param string $email
 * @param string $licenseNumber
 * @param string $serviceDescription
 * @return ChildUser
 */
function add_license($email, $licenseNumber, $serviceDescription) {
	$user = get_user_with_error($email);
	
	foreach ($user->getLicensesJoinService() as $lic) {
		if ($lic->getLicensenumber() == $licenseNumber) {
			print "License number has already been added to user with email[ " . $email . "]  and license [" . $lic . "]"; 
			return $user;
		}		
	}
	
	/**
	 * If we get here this is a new license and we want to add it.  Add a new license
	 */
	$service = ServiceQuery::create()->findOneByDescription($serviceDescription);
	$license = new License();
	$license->setService($service);
	$license->setLicensenumber($licenseNumber);
	
	$user->addLicense($license);
	$user->save();
	
	return $user;
}

/**
 * 
 * @param unknown $user
 * @param unknown $name
 * @param unknown $value
 * @param string $type If not set expects the name to be the column name.  
 * @return boolean
 */
function _update_user_setting($user, $name, $value, $type=null) {
	$_type = $type == null ? TableMap::TYPE_COLNAME : $type;
	$user->setByName($name, $value, $_type);
}

/**
 * Sets the values for the user.  This can be any column however is really meant to set the settings like the start and
 * end times for a day.  
 * 
 * @param string $email
 * @param array $values array of values to set.
 * @return ChildUser - Updated user object.
 */
function update_settings_and_get($email, $values) {
	# Get user and fail if there is not one.
	$user = get_user_with_error($email);
	return update_settings($user, $values);
}
	
/**
 * @param User $user
 * @param array $values
 * @return ChildUser
 */
function update_settings($user, $values) { 
	$keys = UserTableMap::getFieldNames(TableMap::TYPE_COLNAME);
	$table_name = "user.";
	
	foreach ($keys as $key) {
		$k = explode(".", $key);
		
		if (array_key_exists($k[1], $values)) {
			$value = $values[$k[1]];
			_update_user_setting($user, $key, $value);
		}
	}
	
	$user->save();
	
	return $user;
}

/**
 * Adds a new location to the user keyed by email.  The user must exists and will error
 * if it is not found.
 * 
 * @param string $email
 * @param double $longitude
 * @param double $latitude
 */
function check_in_location($email, $longitude, $latitude) {
	$user = get_user_with_error($email);
	$user->addLocationCoordinates($longitude, $latitude);
	$user->save();
	
	return $user;
}


?>