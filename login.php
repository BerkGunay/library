<?php
require 'config/db.php';
session_start();
/* User login process, checks if user exists and password is correct */


if (isset($_POST['login'])) { //user logging in

    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM user WHERE email='$email'");

    if ( $result->num_rows == 0 ){ // User doesn't exist
        $_SESSION['message'] = "User with that email doesn't exist!";
        header("location: error.php");
    }
    else { // User exists
        $user = $result->fetch_assoc();

        if ( password_verify($_POST['password'], $user['password']) ) {
            
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['allowed'] = $user['allowed'];
            $_SESSION['id'] = $user['id'];
            
            // This is how we'll know the user is logged in
            $_SESSION['logged_in'] = true;

            if($user['name'] == 'root' or $user['name'] == 'admin'){
                $_SESSION['isAdmin'] = true;
            }else{
                $_SESSION['isAdmin'] = false;
            }

            header("location: index.php");
        }
        else {
            $_SESSION['message'] = "You have entered wrong password, try again!";
            header("location: error.php");
        }
    }
    
}
// Escape email to protect against SQL injections

?>


<?php require 'inc/header.php'; ?>
    <form action="login.php" method="post" autocomplete="off">
    <div class="container">
        <h1>Login</h1>
        <p>Welcome to our library system!</p>
        <br>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <br><br>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br><br>
    </div>

    <button type="submit" class="button button-block" name="login" />Log In</button>
    </form>
<?php require 'inc/footer.php'; ?>

