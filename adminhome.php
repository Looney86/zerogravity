<!DOCTYPE html>
<html>
<head>
    <title>this is admin</title>
    
    <style>
  *{
	margin: 0;
	padding: 0;
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
.logo{
	width: 300px;
	cursor: pointer;
    margin-top:2vh;
    margin-left:2vh;
}
.ba{
	width: 100%;
	height: 100vh;
	background-image: url(imgs/userhomepage.png);
	background-size: cover;
	background-position: center;
}
.all{
  
  display: inline-flex;
}

.but{
    display: block;
    margin-top:10vh;
    margin-right: 20vh;
    margin-left:20vh;
}

.container{
    display: grid;
    margin-top:-10vh;
    margin-left:25vh;
    justify-content: center;
    align-content: center;
    min-height: 100vh;
    grid-template-columns: 30vw;
    grid-gap: 10px;
     
}

h1{
    text-align: center;
    color: black;
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
    font-size:100%;
    color:white;
    margin-right:5%;
}
.submit-btn{
    background-color: white;
}
.bmi-value{
    width: 60vh;
    height: 5vh;
    background-color: white;
    margin: 2vh 1vh;
    display: grid;
    grid-template-rows: 50% 50%;
}
.status{
    width: 60vh;
    height: 5vh;
    background-color: white;
    margin: 2vh 1vh;
    display: grid;
    grid-template-rows: 50% 50%;
    
}
.container > div{
    
    font-size: 20px;
    font-weight: bold;
    color: black;
    border-radius: 10px;
}



input{
    width: 60vh;
    height: 5vh;
    border: none;
    outline: none;
    font-size: 1.5vw;
    border-radius: 8px;
    display: block; /* display input as block to stack them vertically */
}

input{
    background: white;
    margin: 2vh 1vh;
    text-indent: 0.5em;
    max-width:100% ;
   
    outline: none;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}

button{
    width: 60vh;
    height: 8vh;
    outline: none;
    display: block; 
    padding: 15px 0;
	text-align: centre;
	text-shadow: 2px 2px 2px #000;
	margin: 2vh 1vh;
	border-radius: 25px;
	font-weight: bold;
	font-size: 16pt;
	border: 2px solid #2e73ce;
	background:#2e73ce69;
	color: #ffffff;
	cursor: pointer;
	position: relative;
	
    
   
}

button:hover{
    background:#2e73ce;
    color: white;
    
    
}


</style>
</head>
<body>
<div class="ba">
<div class ="nav">
<a href="#" onclick="window.history.back()" ><img src="imgs/logo.png" class="logo"></a>
<div class = "welc">
      <?php
         session_start(); 
      require 'connection.php';
      if(isset($_SESSION['isloggedin'])){
        echo "Welcome ".$_SESSION['u']."<br/>";
        
        
      }
    
      $u=$_SESSION['u'];
    $query = "SELECT * FROM register WHERE mid='$u'";
  $result = mysqli_query($connection,$query);

      
      mysqli_close($connection);
      ?>
      </div>
      </div>
      <div class="all">
      
      
      
         <div class="but" >
          <a href="adminclasses.php"><button id="b2">CLASSES</button></a>
          <a href="admincoaches.php"><button id="b2">COACHES</button></a>
          <a href="admintutorials.php"><button id="b2">TUTORIALS</button></a>
          <a href="adminitems.php"><button id="b2">EDIT STORE ITEMS</button></a>
          <a href="adminvieworders.php"><button id="b2">VIEW ORDERS</button></a>
          <a href="logout.php"><button id="b2">LOGOUT</button></a>
      </div>

      
    </div>
    </div>


    
</body>
</html>