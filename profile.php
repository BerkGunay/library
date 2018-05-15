<?php 

require 'config/db.php';
session_start();
$userid = $_SESSION['id'];
$books = $mysqli->query("SELECT * FROM book WHERE borrowedby='".$_SESSION['id']."'");

if (isset($_POST['borrow'])){
	$id = $mysqli->escape_string($_POST['id']);
	$sql = "UPDATE book SET borrowedby='$userid' WHERE id='$id'";
	if ($mysqli->query($sql) === TRUE) {
		echo "Book successfuly borrowed!";
	} else {
		echo "Error borrowing: " . $mysqli->error;
	}
}
else if (isset($_POST['return'])){
    $id = $mysqli->escape_string($_POST['id']);
	$sql = "UPDATE book SET borrowedby=0 WHERE id='$id'";
	if ($mysqli->query($sql) === TRUE) {
		echo "Book returned!!";
	} else {
		echo "Error returning: " . $mysqli->error;
	}
}

?>


<?php require 'inc/header.php'; ?>

    <div class="container">
		<h1>Borrow a Book</h1>
        <form action="profile.php" method="post" autocomplete="off">
        <label for="id"><b>Book Id</b></label>
        <input type="text" placeholder="Book Id" name="id" required>
        <br>
    </div>
    <button type="submit" class="button button-block" name="borrow" />Burrow</button>
    </form>

	<h1>Return a Book</h1>
        <form action="profile.php" method="post" autocomplete="off">
        <label for="id"><b>Book Id</b></label>
        <input type="text" placeholder="Book Id" name="id" required>
        <br>
    </div>
    <button type="submit" class="button button-block" name="return" />Return</button>
    </form>

		<h1>Your Borrowed Books List</h1>
		<?php foreach($books as $book) : ?>
			<div class="well">
				<h3><?php echo $book['title']; ?></h3><small> [<?php echo $book['id'];?>]</small>
				<small>Publish date <?php echo $book['publishdate']; ?> by <?php echo $book['author']; ?></small>
				<p><?php echo $book['description']; ?></p>
			</div>
		<?php endforeach; ?>
	</div>
<?php require 'inc/footer.php'; ?>