<?php
include ("connection.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM item where id = '$id'";
    $result = mysqli_query($connection , $sql);
    echo '<script>alert("item deleted");location.href="adminitems.php";</script>';
}