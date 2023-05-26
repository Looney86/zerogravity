<?php

include 'connection.php';

session_start();

$username = $_SESSION['user_id'];

if(!isset($username)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($connection, "SELECT * FROM `cart` WHERE name = '$product_name' AND mid = '$username'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($connection, "INSERT INTO `cart`(mid, name, price, quantity, image) VALUES('$username', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>
<section class="products">

    <h1 class="title">latest products</h1>

    <div class="container">
        <div class="row">

            <?php
            require 'connection.php';
            $select_products = mysqli_query($connection , "SELECT * FROM `item` where type= 1") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="uploaded_img/<?php echo $fetch_products['picture']; ?>" alt="">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $fetch_products['description']; ?></h3>
                                <h4 class="card-text">$<?php echo $fetch_products['price']; ?></h4>

                                <form action="" method="post">
                                    <div class="form-group">
                                        <input type="number" min="1" name="product_quantity" value="1" class="form-control">
                                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['description']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['picture']; ?>">
                                    </div>
                                    <input type="submit" value="Add to Cart" name="add_to_cart" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }else{
                echo '<p class="empty">no products added yet!</p>';
            }
            ?>
        </div>
    </div>

</section>
</body>
</html>
