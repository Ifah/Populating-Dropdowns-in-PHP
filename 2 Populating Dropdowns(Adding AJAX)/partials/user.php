<?php
require '../app/start.php';

if(isset($_GET['user']) && !empty($_GET['user']) && (is_numeric($_GET['user']))){
	
	$userQuery = "
		SELECT
			users.id,
			users.username,
			users_profiles.first_name,
			users_profiles.last_name
		FROM users 
		LEFT JOIN users_profiles
		ON users.id = users_profiles.user_id
		WHERE users.id = :user_id
	";

	$user = $db->prepare($userQuery);
	$user->execute(['user_id' => $_GET['user']]);

	$selectedUser = $user->fetch(PDO::FETCH_ASSOC);

	echo '<pre>', print_r($selectedUser), '</pre>';
}
?>