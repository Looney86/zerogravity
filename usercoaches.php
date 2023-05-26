<?php


include ("connection.php");
    $sql = "SELECT * FROM coach";
$result = $connection->query($sql);
$pic = array();
$name = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($pic, $row["pic"]); 
        array_push($name, $row["name"]); 
}
}
?>

<html>
<head>

    <title>Coaches</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
*{
	margin: 0;
	padding: 0;
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
body 
{
  background-image:url(imgs/coaches.png);
  font-size: 1vh;
  color: #000;
  display: inline;
  justify-content: center;
  align-items: center;
  min-height: 80vh;
}


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
.welc{
    font-size:150%;
    color:white;
    margin-right:5%;
}
.swiper-container 
{
    width: 100%;
    height: 50vh;
    padding-top: 6vh;
    overflow: hidden;
    background-color:#2e73ce69;
    
}


.swiper-slide 
{
   
  background-position: center;
  background-size: cover;
  width: 28vh;
  height: 28vh;
  }
img
{
  width: 100%;
  height:30vh;
  -webkit-box-reflect: below 1vh linear-gradient(transparent,transparent, #0005);
}
.id
{
    color: #fff;
}
h1{color:yellow;}

.button {
  color:blue;
  width:9vh;
  height:4vh;
  background:grey;
}
h2 {
  font-size: 450%;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  text-shadow: 2px 2px 2px #000;
  font-style: italic;
}



</style>
</head>
<body>
<div class ="nav">
<a href="userhome.php" ><img src="imgs/logo.png" class="logo"></a>
<div class = "welc">
<?php
session_start(); 
require 'connection.php';
if(isset($_SESSION['isloggedin'])){
  echo "Welcome ".$_SESSION['u']."<br/>";
  
  
}

$u=$_SESSION['u'];
$query = "SELECT * FROM register WHERE mid='$u'";
$result_session = mysqli_query($connection,$query);





$sql = "SELECT * FROM session";
$result_querry = $connection->query($sql);
$rows = mysqli_fetch_all($result_querry, MYSQLI_ASSOC);
?>
      </div>
      </div>
<div class="c1">
  <h2>MEET OUR PROFESSIONAL TEAM!<h2>
</div>
  <!-- Swiper -->
  

  <div class="swiper-container">
    <div class="swiper-wrapper">
    <?php
    $combined_array = array_combine($name, $pic); 
    foreach ($combined_array as $key => $value):
      echo '<div class="swiper-slide"><h1>' . $key . ' </h1><img src="imgs/' . $value . '" alt=""></div>';
      
    endforeach;
     ?>
    </div>
     
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next id"></div>
    <div class="swiper-button-prev id"></div>
  </div>
    



<script src="swiper.js"></script>    
<script>
    var swiper = new Swiper('.swiper-container', 
    {
     effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 20,
        stretch: 0,
        depth: 200,
        modifier: 1,
        slideShadows: true,
      },
      loop: true,
      autoplay: {
        delay: 1500,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>


</body>
</html>
