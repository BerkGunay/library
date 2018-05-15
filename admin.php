<?php 
//require 'config/config.php';
require 'config/db.php';
session_start();

if($_SESSION['name'] != 'root'){
    $_SESSION['message'] = "You cannot reach to admin panel!".$_SESSION['name'];
    header("location: error.php");
}else {
    $users = $mysqli->query("SELECT * FROM user") or die($mysqli->error());

    if (isset($_POST['allow'])) { //user logging in
        $id = $mysqli->escape_string($_POST['id']);
        $sql = "UPDATE user SET allowed=1 WHERE id='$id'";

        if ($mysqli->query($sql) === TRUE) {
            echo " User allowed to add books successfully";
        } else {
            echo "Error updating record: " . $mysqli->error;
        }
    }
    
    elseif (isset($_POST['disallow'])) { //user registering
        $id = $mysqli->escape_string($_POST['id']);
        $sql = "UPDATE user SET allowed=0 WHERE id='$id'";

        if ($mysqli->query($sql) === TRUE) {
            echo "User disallowed to add books";
        } else {
            echo "Error updating record: " . $mysqli->error;
        }
    }
}
?>


<?php require 'inc/header.php'; ?>
    <div class="container">
		<h1>User List</h1>
		<?php foreach($users as $user) : ?>
			<div class="well">
                    <li><?php echo $user['name'].' id:'. $user['id']. ' allowed: '.$user['allowed'] ?></li>
			</div>
		<?php endforeach; ?>
        <br><br>
        <form action="admin.php" method="post" autocomplete="off">

        <label for="id"><b>User Id</b></label>
        <input type="text" placeholder="User Id" name="id" required>
        <br><br>
    </div>
    <button type="submit" class="button button-block" name="allow" />Allow</button>
    <button type="submit" class="button button-block" name="disallow" />Disallow</button>
    </form>
	</div>
<?php require 'inc/footer.php'; ?>