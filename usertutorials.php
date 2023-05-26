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
    width: 100%;
    height: 40%;
    margin-top: 2%;
    cursor: pointer;
    padding-bottom: 6%;
  }
  
  .nav {
    width: 100%;
    margin: auto;
    padding: 15px 0 15px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  .welc {
    font-size: 150%;
    color: white;
    margin-right: 5%;
  }
  
  .ba {
    width: 100%;
    height: 100vh;
    background-image: url(imgs/userhomepage.png);
    background-size: cover;
    background-position: center;
  }
  
  .scroll-container {
    height: calc(85vh - 80px);
    overflow-y: auto;
  }
  
  .all {
    display: inline-flex;
  }
  
  .but {
    display: block;
    margin-top: 8vh;
    margin-right: 40vh;
    margin-left: 3vh;
  }
  
  .container {
    display: grid;
    margin-top: -12vh;
    margin-right: 15vh;
    margin-left: 2vh;
    justify-content: center;
    align-content: center;
    min-height: 100vh;
    grid-template-columns: 30vw;
    grid-gap: 10px;
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
    <div class="welc">
      <?php
        session_start();
        require 'connection.php';
        if(isset($_SESSION['isloggedin'])){
          echo "Welcome ".$_SESSION['u']."<br/>";
        }

        $u = $_SESSION['u'];
        $query = "SELECT * FROM register WHERE mid='$u'";
        $result_session = mysqli_query($connection, $query);

        $sql = "SELECT * FROM session";
        $result_querry = $connection->query($sql);
        $rows = mysqli_fetch_all($result_querry, MYSQLI_ASSOC);
      ?>
    </div>
  </div>
  <div class="all">
    <div class="scroll-container">
      <div class="but">
        <?php
          // Query the database to get the video links
          $sql = "SELECT * FROM tutorial";
          $result_querry = $connection->query($sql);
          $link = array();
          if ($result_querry->num_rows > 0) {
            while($row = $result_querry->fetch_assoc()) {
              array_push($link, $row["link"]);
            }
          }

          // Loop through the result set and display the video thumbnails
          echo "<div class='video-thumbnails'>";
          foreach ($link as $l) {
            $link = $l;
            // Extract the video ID from the YouTube link
            $video_id = substr($link, strpos($link, "v=") + 2);
            // Generate the thumbnail image URL
            $thumbnail_url = "https://img.youtube.com/vi/".$video_id."/mqdefault.jpg";
            // Display the thumbnail as a link to the video
            echo "<a href='#' class='video-link' data-video-id='".$video_id."'>";
            echo "<img src='".$thumbnail_url."' />";
            echo "</a>";
          }
          echo "</div>";

          // Close the database connection
          mysqli_close($connection);
        ?>
      </div>
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
            $('#video-player').html('<iframe width="560" height="315" src="'+videoUrl+'" frameborder="0" allowfullscreen></iframe>');
          });
        });
      </script>
    </div>
  </div>
</div>
</body>
</html>
