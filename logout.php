<?php
session_start();
if(isset($_SESSION['isloggedin'])){
    $_SESSION = array();
    session_destroy();
    print_r($_SESSION);
    header("location: home.php");
}
?>