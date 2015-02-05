<?php
require 'app/start.php';

$usersQuery = "
	SELECT
		users.id,
		users.username,
		users_profiles.first_name,
		users_profiles.last_name
	FROM users 
	LEFT JOIN users_profiles
	ON users.id = users_profiles.user_id
";

$users = $db->query($usersQuery);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dropdowns</title>
</head>
<body>

	<select name="user" id="user-select">
		<option value="">Choose a user</option>
		<?php foreach($users->fetchAll() as $user): ?>
			<option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
		<?php endforeach; ?>
	</select>
	
	<div id="user-profile"></div>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/global.js"></script>
</body>
</html>