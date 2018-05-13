<?php 
//require 'config/config.php';
require 'config/db.php';
session_start();

$books = $mysqli->query("SELECT * FROM book") or die($mysqli->error());

?>


<?php require 'inc/header.php'; ?>
    <div class="container">
		<h1>Book List</h1>
		<?php foreach($books as $book) : ?>
			<div class="well">
				<h3><?php echo $book['title']; ?></h3>
				<small>Publish date <?php echo $book['publishdate']; ?> by <?php echo $book['author']; ?></small>
				<p><?php echo $book['description']; ?></p>
				<a class="btn btn-default" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Borrow</a>
			</div>
		<?php endforeach; ?>
	</div>
<?php require 'inc/footer.php'; ?>