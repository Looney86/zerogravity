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
</head>
<body>
<div class ="nav">
   <a href="#" onclick="window.history.back()" ><img src="imgs/logo.png" class="logo"></a>
   <ul>
			<li><a href="adminhome.php">HOME</a></li>
			
			
			</ul>
   
</div>
<?php
require_once 'connection.php';
session_start();

if (isset($_POST['change'])) {
    $itemid = $_POST['id'];
    $p = $_POST['price'];
    $qq = "UPDATE item SET price ='$p' WHERE id = '$itemid' ";
    $all_c = mysqli_query($connection, $qq);
}

if (isset($_POST['add'])) {
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $targetDir = 'uploaded_img/';
    $imageName = $_FILES['image']['name'];
    $imagePath = $targetDir . $imageName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        $query = "INSERT INTO item (description, picture, price, type) VALUES ('$description', '$imageName', '$price', '$type')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<script>alert('item added succefully');location.href='adminitems.php';</script>";
        } else {
            echo "Failed to add item. Please try again.";
        }
    } else {
        echo "Failed to upload image. Please try again.";
    }
}
$query = "SELECT * FROM item";
$result = mysqli_query($connection, $query);
$results = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<link rel="stylesheet" href="bootstrap.min.css">

<div class="container">
    <h2 class="text-center mb-4">Add Item</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control-file" name="image" required>
                        </div>
                        <div class="form-group">
                                    <label for="type">Select Type:</label>
                                    <select class="form-control" name="type">
                                        <option value="1">Gadget</option>
                                        <option value="2">Food</option>
                                    </select>
                                </div>

                                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" name="price" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="add">Add Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($results)): ?>
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($results as $row): ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="uploaded_img/<?= $row['picture'] ?>" alt="<?= $row['description'] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['description'] ?></h5>
                            <p class="card-text">$<?= $row['price'] ?></p>
                            <form method="POST">
                                <div class="form-group">
                                    <input type="hidden" value="<?= $row['id'] ?>" name="id" />
                                    <input type="text" class="form-control" placeholder="New Price" name="price" />
                                </div>
                                <button type="submit" class="btn btn-primary" name="change">Change</button>
                            </form>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <p class="text-center">No items found.</p>
<?php endif; ?>

<script src="bootstrap.min.js"></script>

    
</body>
