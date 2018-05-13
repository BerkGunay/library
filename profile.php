<?php 

require 'config/db.php';
session_start();
$books = $mysqli->query("SELECT * FROM book WHERE borrowedby='".$_SESSION['id']."'");

if (isset($_POST['return'])){
    $books = $mysqli->query("SELECT * FROM book WHERE id=");
}

?>


<?php require 'inc/header.php'; ?>
    <div class="container">
		<h1>Your Borrowed Books List</h1>
		<?php foreach($books as $book) : ?>
			<div class="well">
				<h3><?php echo $book['title']; ?></h3>
				<small>Publish date <?php echo $book['publishdate']; ?> by <?php echo $book['author']; ?></small>
				<p><?php echo $book['description']; ?></p>
                <form action="/profile.php" method="post">
                <input type="hidden" name="MyButtonValue" value="<? echo $book['id'] ?>" />
                <button name="return" type="submit" value="<? echo $book['id'] ?>">Return</button>
                </form>
			</div>
		<?php endforeach; ?>
	</div>
<?php require 'inc/footer.php'; ?>