<?php
use Base\UserQuery;
// use Composer\Autoload\ClassLoader;
// use Base\UserQuery;
require_once 'db/propel-bootstrap.php';

/**
 * @param User id $user_name.  Should not use wild cards.
 * @return Singe entry.  
 */
function get_user($user_name) {
	return UserQuery::create()
		->findOneByUsername($user_name);
}



$user = get_user("oglakan");

print $user;
// print $user->getCreatedAt();

// $user = new User();
// $user->setFirstname("Matthew");
// $user->setLastname("Triviski");
// $user->setUsername("butt");
// $user->setAddress("Some fuking address");
// $user->setPhonenumber("8182593547");
// $user->setEmail("balls@gmail.com");

// $user->save();

// $users = UserQuery::create()
// 	->filterByUsername("oglak%");

// foreach($users as $user) {
// 	print $user;
// }
// echo "all is good";
?>
