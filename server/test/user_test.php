<?php
include 'controllers/user/user.php';

$email = 'matt@balls.com';

$user = get_user_with_error($email);

$settings = [
		"mondayStart" => "06:00:00",
		"mondayEnd" => "20:00:00",
		"phoneOk" => false
];

$updated = update_settings($user, $settings);
$user = new User();

$longitude = time() + 0.88888;
$latitude = time() + 1.23456;
$updated = check_in_location($updated->getEmail(), $longitude, $latitude);

foreach ($updated->getLocations() as $loc) {
	print $loc;
	print "<p>";
}

?>
