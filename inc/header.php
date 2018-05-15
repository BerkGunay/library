<?php
if (isset($_SESSION['logged_in'])){
	if ($_SESSION['logged_in'] != NULL){
		$loggedin = $_SESSION['logged_in'];
	} else {
		$loggedin = 0;
	}
} else {
	$loggedin = 0;
}

if (isset($_SESSION['isAdmin'])){
	if ($_SESSION['isAdmin'] != NULL){
		$isadmin = $_SESSION['isAdmin'];
	} else {
		$isadmin = 0;
	}
} else {
	$isadmin = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Library</title>
    <meta charset="UTF-8">
</head>
<body>
	<ul>
		<li><a href="index.php">Book List</a></li>
	<?php if($loggedin == 1): ?>
		<li><a href="profile.php">Profile</a></li>
		<li><a href="addbook.php">Add a Book</a></li>
		<?php if($isadmin == 1): ?>
			<li><a href="admin.php">Admin Panel</a></li>
		<?php endif; ?>
		<li><a href="logout.php">Logout</a></li>
	<?php else: ?>
		<li><a href="register.php">Register</a></li>
		<li><a href="login.php">Login</a></li>
	<?php endif; ?>
		
	</ul>