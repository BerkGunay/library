<?php
session_start();
require 'config/db.php';

if (isset($_POST['addbook'])) {

    // Check if user is logged in using the session variable
    if ( $_SESSION['logged_in'] != 1 or $_SESSION['allowed'] != 1) {
        $_SESSION['message'] = "You must be allowed to add books!";
        header("location: error.php");    
    }
    else {
        // Makes it easier to read
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];

        $title = $mysqli->escape_string($_POST['title']);
        $author = $mysqli->escape_string($_POST['author']);
        $genre = $mysqli->escape_string($_POST['genre']);
        $description = $mysqli->escape_string($_POST['description']);
        $publishdate = $mysqli->escape_string($_POST['publishdate']);
        $pagenum = $mysqli->escape_string($_POST['pagenum']);
        $addedby = $_SESSION['id'];
        $addedbyname = $_SESSION['name'];

        $result = $mysqli->query("SELECT * FROM user WHERE title='$title' AND author='$author'");
        if ( $result->num_rows > 0 ) {
        
            $_SESSION['message'] = 'Book from the same author already exists!';
            header("location: error.php");
            
        }
    
        else { 
            $sql = "INSERT INTO book (title, author, genre, description, publishdate, pagenum, addedby, addedbyname) " 
                    . "VALUES ('$title','$author','$genre','$description','$publishdate','$pagenum', '$addedby', '$addedbyname')";
            // Add book to the database
            if ( $mysqli->query($sql) ){
                header("location: index.php"); 
            }
            else {
                $_SESSION['message'] = 'Ading book failed!';
                header("location: error.php");
            }
        }
    }
    
}

?>

<?php require 'inc/header.php'; ?>
    <form action="addbook.php" method="post" autocomplete="off">
    <div class="container">
        <h1>Add a Book</h1>
        <p> Wellcome <?php echo $_SESSION['name'] ?> Please fill in this form to add a book into the system.</p>
        <br>

        <label for="title"><b>Title</b></label>
        <input type="text" placeholder="Enter Title" name="title" required>
        <br><br>

        <label for="author"><b>Author</b></label>
        <input type="text" placeholder="Enter Author" name="author" required>
        <br><br>

        <label for="genre"><b>Genres</b></label>
        <input type="text" placeholder="Enter Genres" name="genre" required>
        <br><br>

        <label for="description"><b>Description</b></label>
        <input type="text" placeholder="Enter Description" name="description" required>
        <br><br>

        <label for="publishdate"><b>Publish Date</b></label>
        <input type="text" placeholder="Enter Publish Date" name="publishdate" required>
        <br><br>

        <label for="pagenum"><b>Page Number</b></label>
        <input type="text" placeholder="Enter Page Number" name="pagenum" required>
        <br><br>
    </div>

    <button type="submit" class="button button-block" name="addbook" />Add</button>
    </form>
<?php require 'inc/footer.php'; ?>

