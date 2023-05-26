<?php
session_start();
require 'connection.php';





if (isset($_POST['accept'])) {
   $orderId = $_POST['id'];
   $updateOrderSQL = "UPDATE orders SET status = 2 WHERE id = '$orderId'";
   mysqli_query($connection, $updateOrderSQL);
}

$selectOrders = mysqli_query($connection, "SELECT o.*, m.username as user_name FROM orders o  
JOIN member m on o.mid = m.id where o.status=1");
$orders = mysqli_fetch_all($selectOrders, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <style>
      .logo{
 	width: 100%;
  height:40%;
  margin-top:2%;
	cursor: pointer;
  padding-bottom:6%;
 
}
.nav{
	width: 100%;
	margin: auto;
	padding: 15px 0 15px 0;
	display: flex;
	align-items: center;
	justify-content: space-between;
	
}

ul {
  width: 25%;
  margin: 0;
  margin-top: 2%;
  padding: 5px;
  overflow: hidden;
  background-color:#2e73ce69;
  list-style-type: none;
  

}
li {
  float: left;
}

li a{
  display: inline-block;
  font-size: 130%;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  text-shadow: 2px 2px 2px #000;
  
}
      </style>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin View Orders</title>
   
   <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<div class ="nav">
   <a href="#" onclick="window.history.back()" ><img src="imgs/logo.png" class="logo"></a>
   <ul>
			<li><a href="adminhome.php">HOME</a></li>
			
			
			</ul>
   
</div>
   <div class="container">
  
      <h1>Members Orders</h1>
      <table class="table">
         <thead>
            <tr>
               <th>Order ID</th>
               <th>Username</th>
               <th>Item name</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($orders as $order) { ?>
               <tr>
                  <td><?php echo $order['id']; ?></td>
                  <td><?php echo $order['user_name']; ?></td>
                  <td><?php echo $order['name']; ?></td>
                  <td><?php echo $order['price']; ?></td>
                  <td><?php echo $order['quantity']; ?></td>
                  <td>
                     <?php if ($order['status'] == 1) { ?>
                        <form method="POST" action="">
                           <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                           <button type="submit" name="accept" class="btn btn-primary">Accept</button>
                        </form>
                     <?php } ?>
                  </td>
               </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
   
   <script src="bootstrap.min.js"></script>
</body>
</html>