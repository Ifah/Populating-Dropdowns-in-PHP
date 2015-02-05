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

if(isset($_GET['user']) && !empty($_GET['user']) && (is_numeric($_GET['user']))){
	
	$userQuery = "
		{$usersQuery}
		WHERE users.id = :user_id
	";

	$user = $db->prepare($userQuery);
	$user->execute(['user_id' => $_GET['user']]);

	$selectedUser = $user->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dropdowns</title>
</head>
<body>

	<form action="listing.php" method="get">
		<select name="user">
			<option value="">Choose a user</option>
			<?php foreach($users->fetchAll() as $user): ?>
				<option value="<?php echo $user['id']; ?>" <?php echo isset($selectedUser) && $selectedUser['id'] == $user['id'] ? ' selected' : ''; ?>><?php echo $user['username']; ?></option>
			<?php endforeach; ?>
		</select>
		<input type="submit" value="Show details">
	</form>
	<?php if(isset($selectedUser)): ?>
		<pre><?php print_r($selectedUser); ?></pre>
		<?php echo $selectedUser['last_name']; ?>
	<?php endif; ?>
</body>
</html>