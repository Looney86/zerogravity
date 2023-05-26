
<html>
<head>
    <title>this is admin</title>
    <link href="Style.css" rel="stylesheet" type="text/css">
</head>
<style>
    select {
	width: 150px;
	height: 50px;
    font-size: 30px;
    margin: 15px 25px;
    
}

    </style>
<body>
    <div class="pba">
        <div class="pnav">
            <img src="logo.png" class="logo">
            <ul>
            <li><a href="profileAdmin.php">Home</a></li>
            <li><a href="logout.php">Log out</a></li>
            </ul>
        </div>
    </div>
    <div class="pcontent">
        <h1>
        Update User Password
        </h1>
 <div class="=plan">
        <div class="row">
            <form action="" method="GET">
     

        <select name ="Item">
        <?php
        require_once "connection.php";
        $q = "SELECT * FROM `item` ";
        $all_c = mysqli_query($connection,$q);
        while ($ca = mysqli_fetch_array(
            $all_c,MYSQLI_ASSOC)):;
            
?>
<option value="<?php echo $ca["description"];
               
                ?>">
                    <?php echo $ca["description"];
                   
                    ?>
                </option>
                <?php
                endwhile;
          
            ?>
        </select>
        
        <input name="submit" type="submit"  value="Update">
        <input type="text" name="price" placeholder="Enter New price">

        </div>
    </div>
    </div>
    <?php
    if(isset($_GET['submit'])){
$f = $_GET['Item'];
$p = $_GET['price'];
$qq = "UPDATE `item` SET `price`='$p' WHERE `description`='$f'";
$all_c = mysqli_query($connection,$qq);
    }
    ?>

    
</body>
</html>