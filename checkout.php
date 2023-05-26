<?php
session_start();
require 'connection.php';

$username = $_SESSION['u'];

if (!isset($username)) {
   header('location:login.php');
}

if (isset($_SESSION['isloggedin'])) {

   $userId = $_SESSION['user_id'];

}
var_dump($userId);
var_dump($username);
   $selectCart = mysqli_query($connection, "SELECT * FROM `cart` WHERE mid = '$userId'");
   $carts = mysqli_fetch_all($selectCart, MYSQLI_ASSOC);

   foreach ($carts as $cart) {
      $itemname = $cart['name'];
      $price = $cart['price'];
      $quantity = $cart['quantity'];

      $insertOrderSQL = "INSERT INTO orders (mid, name, price, quantity) VALUES ('$userId', '$itemname', '$price', '$quantity')";
      mysqli_query($connection, $insertOrderSQL);
   }

  $delete = "DELETE FROM cart where mid = '$userId'";
  $result = mysqli_query($connection,$delete); 

   echo '<script>alert("Order Sent to Admin");location.href="usercart.php";</script>';
?>
