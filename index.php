<?php 
//require 'config/config.php';
require 'config/db.php';
session_start();

$books = $mysqli->query("SELECT * FROM book WHERE borrowedby=0 ") or die($mysqli->error());

?>


<?php require 'inc/header.php'; ?>
    <div class="container">
		<h1>Book List</h1>
		<?php foreach($books as $book) : ?>
			<div class="well">
				<hr>
				<h3><?php echo $book['title']; ?></h3><small> [<?php echo $book['id'];?>]</small>
				<small>Publish date <?php echo $book['publishdate']; ?> by <?php echo $book['author']; ?></small>
				<p><?php echo $book['description']; ?></p>
				<p><small>Added by: <?php echo $book['addedbyname'];?></small><p>
				<hr>
			</div>
		<?php endforeach; ?>
	</div>
<?php require 'inc/footer.php'; ?>