<!DOCTYPE html>
<html lang="en">
<head>
<style>
  * {
    margin: 0;
    padding: 0;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  }
  
  .logo {
    width: 300px;
    cursor: pointer;
    margin-top: 2vh;
    margin-left: 2vh;
  }
  
  .ba {
    position: relative;
    height: 100vh;
    overflow: hidden;
  }
  
  .ba:before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    background-image: url(imgs/tutorialsbg.png);
    background-size: cover;
    background-position: center;
  }
  
  .nav {
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
    background-color: #2e73ce69;
    list-style-type: none;
  }
  
  li {
    float: left;
  }
  
  li a {
    display: inline-block;
    font-size: 130%;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    text-shadow: 2px 2px 2px #000;
  }
  
  .all {
    display: flex;
    justify-content: space-between;
  }
  
  .but {
    overflow-y: auto;
    max-height: calc(100vh - 70px); /* Adjust the height as needed */
    margin-top: 10vh;
    margin-right: 40vh;
    margin-left: 3vh;
  }
  
  .container {
    display: grid;
    margin-right: 15vh;
    margin-left: 2vh;
    justify-content: center;
    align-content: center;
    min-height: 100vh;
    grid-template-columns: 30vw;
    grid-gap: 10px;
  }
  
  .btn-danger {
    color: white;
    background-color: darkred;
    padding: 8px 16px;
    border-radius: 4px;
    border: none;
    font-size: 16px;
    cursor: pointer;
  }
  
  .btn-danger:hover {
    background-color: red;
  }
  
  .video-thumbnails {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
  }
  
  .video-thumbnails a {
    display: block;
    margin: 2vh;
    width: calc(33.33% - 25px);
    text-align: center;
  }
  
  #video-player {
    height: 40%;
    width: 100%;
    margin-right: 20vh;
    margin-left: 2vh;
    position: relative;
    padding-bottom: 56.25%;
    overflow: hidden;
  }
  
  #video-player iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
</style>
</head>
<body>
<div class="ba">
  <div class="nav">
    <a href="#" onclick="window.history.back()"><img src="imgs/logo.png" class="logo"></a>
    <ul>
      <li><a href="insertvideo.php">Add Tutorials</a></li>
      <li><a href="adminhome.php">Back to Home</a></li>
    </ul>
  </div>
  <div class="all">
    <div class="but">
      <?php
        session_start(); 
        require 'connection.php';
        if (isset($_SESSION['isloggedin'])) {
          
        }
        if (isset($_POST['delete'])) {
          $id = $_POST['id'];

          $sql = "DELETE FROM tutorial where link = '$id'";
          $del = mysqli_query($connection, $sql);
        }

        $sql = "SELECT * FROM tutorial";
        $result_querry = $connection->query($sql);
        $link = array();
        if ($result_querry->num_rows > 0) {
          while ($row = $result_querry->fetch_assoc()) {
            array_push($link, $row["link"]);
          }
        }

        echo "<div class='row'>";
        echo "<div class='video-thumbnails'>";
        foreach ($link as $l) {
          $link = $l;

          $video_id = substr($link, strpos($link, "v=") + 2);

          $thumbnail_url = "https://img.youtube.com/vi/" . $video_id . "/mqdefault.jpg";

          echo "<div class='col-md-3'>"; 

          echo "<div class='video-thumbnail'>";
          echo "<a href='#' class='video-link' data-video-id='" . $video_id . "'>";
          echo "<img src='" . $thumbnail_url . "' />";
          echo "</a>";

          echo "<form method='post'>";
          echo "<input type='hidden' name='id' value='" . $l . "'>";
          echo "<button type='submit' class='btn-danger' name='delete' onclick=\"return confirm('Are you sure you want to delete the video?');\">Delete</button>";

          echo "</form>";

          echo "</div>";
          echo "</div>";
        }
        echo "</div>";
        echo "</div>";
      ?>
    </div>
    <div class="container">
      <div id="video-player"></div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
        $(document).ready(function() {
          $('.video-link').click(function(e) {
            e.preventDefault();
            var videoId = $(this).data('video-id');
            var videoUrl = 'https://www.youtube.com/embed/' + videoId;
            $('#video-player').html('<iframe width="560" height="315" src="' + videoUrl + '" frameborder="0" allowfullscreen></iframe>');
          });
        });
      </script>
    </div>
  </div>
</div>
</body>
</html>
