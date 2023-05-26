<!DOCTYPE html>
<html lang="en">
<head>
  <title>ZeroGravity</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
 
  <style>
  *{
	margin: 0;
	padding: 0;
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

.logo{
	width: 300px;
	cursor: pointer;
}

.ba{
	width: 100%;
	height: 100vh;
	background-image: url(imgs/home.png);
	background-size: cover;
	background-position: center;
}
.nav{
	width: 100%;
	margin: auto;
	padding: 15px 0 15px 0;
	display: flex;
	align-items: center;
	justify-content: space-between;
	
}
.logo{
	margin-top: 2%;
	width: 25%;
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

.content{
	width: 100%;
	margin: auto;
	position: absolute;
  	top: 50%;
	transform: translateY(-50%);
	text-align: center;
  	display: flexbox;
}
.content h1{
	font-size: 4vw;
	text-shadow: 2px 2px 2px #000;
	margin-top: 10%;
	transform: translateY(-50%);
  	color: #ffffff;
}
.content p{
	font-size: 100%;
	margin: 20px auto;
	font-weight: 100;
	line-height: 25px;
	color: rgb(33, 31, 31);
}
#b1 {
    width: 140px;
    font-size: 14pt;
    font-weight: bold;
    text-align: centre;
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 10px 20px;
    background-color: transparent;
    color: #ffffff;
    border:rgb(33, 31, 31);
    border-radius: 0px;
    cursor: pointer;
	text-shadow: 2px 2px 2px #000;
  }
  #b2{
	width: 330px;
	padding: 15px 0;
	text-align: centre;
	text-shadow: 2px 2px 2px #000;
	margin: 20px 10px;
	border-radius: 25px;
	font-weight: bold;
	font-size: 16pt;
	border: 2px solid #2e73ce;
	background:#2e73ce69;
	color: #ffffff;
	cursor: pointer;
	position: relative;
	overflow: hidden;
}

span{
	background: #2e73ce;
	height:100%;
	width: 0%;
	border-radius: 25px;
	position: absolute;
  	left: 0;
	bottom: 0;
	z-index: -1;
	transition: 0.2s;
  
}
button:hover span{
	width: 100%;
}

</style>
</head>



<body>

<div class="container">

   <div class="ba">
	 
    <div class="nav">
		<img src="imgs/logo.png" class="logo">
			<ul>
			<li><a href="login.php">LOGIN</a></li>
			<li><a href="coaches.php">COACHES</a></li>
			<li><a href="classes.php">CLASSES</a></li>
			</ul>
    </div>
        
</div>

<div class="content">
      <h1>
          Results, Not Promises.
      </h1>
        
        <div>
          <a href="listclasses.php"><button id="b2"><span></span>VIEW CLASSES SCHEDULE</button></a>
      </div>
</div>
<a href="aboutus.php"><button id="b1">About us</button></a>
</div>

</body>
</html>