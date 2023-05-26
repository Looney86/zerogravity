<!DOCTYPE html>
<html>
<head>
  <title>Coach Management</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'adminheader.php'; ?>
  <div class="container">
    <h1>Coach Management</h1>
    <div class="card mx-auto"> <!-- Added mx-auto class to center the form -->
      <div class="card-body">
        <h5 class="card-title">Add Coach</h5>
        <form method="POST" action="" enctype="multipart/form-data">
          <div class="form-group">
            <label for="addCoachName">Coach Name</label>
            <input type="text" name="addCoachName" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="addCategory">Category</label>
            <select name="addCategory" class="form-control">
              <?php
                include("connection.php");

                // Fetch categories from the database and populate the select options
                $query = 'SELECT * FROM category';
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="addProfileImage">Profile Image</label>
            <input type="file" name="addProfileImage" class="form-control-file" accept="image/*" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Coach</button>
        </form>
      </div>
    </div>
    
    <div id="coachesContainer" class="row">
      <?php
        include("connection.php");

       
          
          if (isset($_POST['update'])) {
            $coachId = $_POST['coachId'];
            $newCoachName = $_POST['coachName'];

            $updateQuery = "UPDATE coach SET name = '$newCoachName' WHERE id = '$coachId'";
            mysqli_query($connection, $updateQuery);
          }
          
          if(isset($_POST['delete'])){

            $id = $_POST['id'];

            $check = "SELECT * FROM session_details where coach = '$id'";
            $result = mysqli_query($connection, $check);

            if (mysqli_num_rows($result) > 0){
              echo '<script>alert("Coach is connected to a session");location.href="adminmanagecoach.php";</script>';
            }else{

            

            $delete = "DELETE FROM coach where id = '$id'";
            mysqli_query($connection, $delete);
            echo '<script>alert("coach deleted");location.href="adminmanagecoach.php";</script>';
            }
          }
        
          if (isset($_POST['coachId']) && isset($_FILES['profileImage'])) {
            $coachId = $_POST['coachId'];

            if ($_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
              $tmpName = $_FILES['profileImage']['tmp_name'];
              $fileName = $_FILES['profileImage']['name'];
              $targetDir = 'imgs/';
              $targetPath = $targetDir . $fileName;

              move_uploaded_file($tmpName, $targetPath);

              $updateQuery = "UPDATE coach SET pic = '$fileName' WHERE id = '$coachId'";
              mysqli_query($connection, $updateQuery);
            }
          }

          // Handle adding a new coach
          if (isset($_POST['addCoachName']) && isset($_POST['addCategory']) && isset($_FILES['addProfileImage'])) {
            $addCoachName = $_POST['addCoachName'];
            $addCategory = $_POST['addCategory'];

            if ($_FILES['addProfileImage']['error'] === UPLOAD_ERR_OK) {
              $tmpName = $_FILES['addProfileImage']['tmp_name'];
              $fileName = $_FILES['addProfileImage']['name'];
              $targetDir = 'imgs/';
              $targetPath = $targetDir . $fileName;

              move_uploaded_file($tmpName, $targetPath);

              $insertQuery = "INSERT INTO coach (name, category, pic) VALUES ('$addCoachName', '$addCategory', '$fileName')";
              mysqli_query($connection, $insertQuery);
            }
          }
        

        $query = 'SELECT * FROM coach';
        $result = mysqli_query($connection, $query);
        $results = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        foreach ($results as $row) {
          $coachId = $row['id'];
          $coachName = $row['name'];
          $coachImage = $row['pic'];
    
          echo '<div class="card col-md-4">';
          echo '<img class="card-img-top" src="imgs/' . $coachImage . '">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title">' . $coachName . '</h5>';
          echo '<form method="POST" action="">';
          echo '<input type="hidden" name="coachId" value="' . $coachId . '">';
          echo '<div class="form-group">';
          echo '<label for="coachName">Coach Name</label>';
          echo '<input type="text" name="coachName" class="form-control" value="' . $coachName . '">';
          echo '</div>';
          echo '<button type="submit" name="update" class="btn btn-primary">Update Name</button>';
          echo '</form>';
          echo '<form method="POST" action="" enctype="multipart/form-data">';
          echo '<input type="hidden" name="coachId" value="' . $coachId . '">';
          echo '<div class="form-group">';
          echo '<label for="profileImage">Change Profile Image</label>';
          echo '<input type="file" name="profileImage" class="form-control-file" accept="image/*">';
          echo '</div>';
          echo '<button type="submit" class="btn btn-secondary">Change Profile</button>';
          echo '</form>';
          echo '<form method="POST" action="">';
          echo '<input type="hidden" name="id" value="' . $coachId . '">';
          echo '<button type="submit" name="delete" class="btn btn-danger">Delete Coach</button>';
          echo '</form>';
          echo '</div>';
          echo '</div>';
        }

      ?>
    </div>
    
  <script src="bootstrap.min.js"></script>
</body>
</html>
