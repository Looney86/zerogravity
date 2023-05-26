<?php
         session_start(); 
      require 'connection.php';
      
$username = $_SESSION['user_id'];

if(!isset($username)){
   header('location:login.php');
}
      if(isset($_SESSION['isloggedin'])){
   

      }
    
      $u=$_SESSION['user_id'];
    $query = "SELECT * FROM register WHERE mid='$u'";
  $result = mysqli_query($connection,$query);


if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($connection, "UPDATE cart SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($connection, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:usercart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($connection, "DELETE FROM `cart` WHERE mid = '$u'") or die('query failed');
   header('location:usercart.php');
}

?>
      
 

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>shopping cart</h3>
   <p> <a href="useritems.php">Continue Shoping</a> / cart </p>
</div>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         $select_cart = mysqli_query($connection, "SELECT * FROM `cart` WHERE mid = '$username'") or die('query failed');
         $carts = mysqli_fetch_all($select_cart,MYSQLI_ASSOC);
       foreach($carts as $cart){  
      ?>
      <div class="box">
      <form method="GET">
   <input type="hidden" name="delete" value="<?php echo $cart['id']; ?>">
   <button type="submit" class="fas fa-times" onclick="return confirm('Delete this from cart?')"></button>
</form>         <img src="uploaded_img/<?php echo $cart['image']; ?>" alt="">
         <div class="name"><?php echo $cart['name']; ?></div>
         <div class="price">$<?php echo $cart['price']; ?></div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $cart['id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $cart['quantity']; ?>">
            <input type="submit" name="update_cart" value="update" class="option-btn">
         </form>
         <div class="sub-total"> sub total : <span>$<?php echo $sub_total = ($cart['quantity'] * $cart['price']); ?></span> </div>
      </div>
      <?php
      $grand_total += $sub_total;
         }
     if($carts == 0){
      echo "cart empty";
     }
      
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="usercart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <div class="cart-total">
      <p>grand total : <span>$<?php echo $grand_total; ?></span></p>
      <div class="flex">
         <a href="useritems.php" class="option-btn">continue shopping</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
      </div>
   </div>

</section>











<script src="js/script.js"></script>

</body>
</html>