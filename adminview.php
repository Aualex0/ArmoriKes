<?php
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

$user = ""; //prevent the "no index" error from $_POST
$pass = "";
if (isset($_POST['user'])) { // check for them and set them so
    $user = $_POST['user'];
}
if (isset($_POST['pass'])) { // so that they don't return errors
    $pass = $_POST['pass'];
}    

$useroptions = ['cost' => 8,]; // all up to you
$pwoptions   = ['cost' => 8,]; // all up to you
$userhash    = password_hash($user, PASSWORD_BCRYPT, $useroptions); // hash entered user
$passhash    = password_hash($pass, PASSWORD_BCRYPT, $pwoptions);  // hash entered pw
$hasheduser  = file_get_contents("stuff/user.txt"); // this is our stored user
$hashedpass  = file_get_contents("stuff/pass.txt"); // and our stored password


if (password_verify($user, $hasheduser) 
    && password_verify($pass,$hashedpass) 
    && !empty($_POST['token']) 
    && hash_equals($_SESSION['token'], $_POST['token'])) {

    // the password verify is how we actually login here
    // the $userhash and $passhash are the hashed user-entered credentials
    // password verify now compares our stored user and pw with entered user and pw

    include "stuff/secure.php";

} else { 
    // if it was invalid it'll just display the form, if there was never a $_POST
    // then it'll also display the form. that's why I set $user to "" instead of a $_POST
    // this is the right place for comments, not inside html
    ?>  
    <form method="POST" action="adminview.php">
    Username : <input type="text" name="user"></input><br/>
    Password : <input type="password" name="pass"></input><br/>
    <input type="submit" name="submit" value="Go"></input>
    <input type="hidden" name="token" value="<?php echo $token?>">
    </form>
    <?php 
} 