<?php 
require 'config/db.php';
session_start();

if (isset($_POST['register'])) { //user registering

    $name = $mysqli->escape_string($_POST['name']);
    $email = $mysqli->escape_string($_POST['email']);
    $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));

    // Check if user with that email already exists
    $result = $mysqli->query("SELECT * FROM user WHERE email='$email'") or die($mysqli->error());

    if ( $result->num_rows > 0 ) {
        
        $_SESSION['message'] = 'User with this email already exists!';
        header("location: error.php");
        
    }

    else { // Email doesn't already exist in a database, proceed...

        // active is 0 by DEFAULT (no need to include it here)
        $sql = "INSERT INTO user (name, email, password) " 
                . "VALUES ('$name','$email','$password')";

        // Add user to the database
        if ( $mysqli->query($sql) ){

            header("location: login.php"); 

        }

        else {
            $_SESSION['message'] = 'Registration failed!';
            header("location: error.php");
        }

    }
    
}


?>


<?php require 'inc/header.php'; ?>
    <form action="register.php" method="post" autocomplete="off">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an library membership.</p>
        <br>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>
        <br><br>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <br><br>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br><br>
    </div>

    <button type="submit" class="button button-block" name="register" />Register</button>

    <div class="container signin">
        <p>Already have an account? <a href="/login.php">Sign in</a>.</p>
    </div>
    </form>
<?php require 'inc/footer.php'; ?>

