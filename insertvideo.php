<?php
require_once "connection.php";
if(isset($_POST['link']) ){
$u = $_POST['link'];

$errors= array();

if(count($errors)==0){
$Querry="INSERT INTO `tutorial` (`id`, `link`, `cid`) VALUES ('','$u','1')";
$result = mysqli_query($connection, $Querry);

echo "<script>alert('video inserted');location.href='admintutorials.php';</script>";


if ($result==FALSE) echo ("error description: " .mysqli_error($connection));

}
}
?>

<!DOCTYPE html>
<html>
	
<head>
    <title>Zero Gravity</title>
	
    </head>
    <style>
        *{
	margin: 0;
	padding: 0;
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .lbar{
	width: 100%;
	height: 100vh;
	background-image:url(imgs/register.png);
	background-size: cover;
	background-position: center;
    }
    .lnavr{
	width: 85%;
	margin: auto;
	padding: 35px 0;
	display: flex;
	align-items: center;
	justify-content: space-between;
    }
    .registerbox{
	width: 30%;
	height:100%;
	background:transparent;
	background-image: linear-gradient(rgba(46, 115, 206, 0.666),rgba(46, 115, 206, 0.777));
	top: 50%;
	left: 50%;
	position: absolute;
	transform: translate(-50%,-50%);
	box-sizing: border-box;
	padding: 70px 30px;
	
}
.registerbox h1{
	margin: o;
	padding: 0 0 20px;
	text-align: center;
	font-size: 22px;
	color: #fff;
}
.registerbox p{
	margin: 0;
	padding: 0;
	font-weight: bold;
	color: #fff;
}
.registerbox input{
	width: 100%;
	margin-bottom: 20px;
}
.registerbox input[type="text"], input[type="password"]{
	border: none;
	border-bottom: 1px solid #fff;
	background: transparent;
	outline: none;
	height: 40px;
	color: aliceblue;
	font-size: 16px;
	text-shadow: 0.5px 0.5px 0.5px #000;
}
.registerbox input[type="submit"]{
	border: none;
	outline: none;
	height: 38px;
	background: aliceblue;
	color: #000;
	font-size: 18px;
	border-radius: 20px;
	
}
.registerbox input[type="submit"]:hover{
	cursor: pointer;
	background: #2e73ce;
	color: aqua;
}

    </style>
<body>
<form action ="insertvideo.php" method="POST" id= "myform" onsubmit="return validate_form();">
    <div class="lbar">
        <div class="lnavr">
        <a href="#" onclick="window.history.back()" ><img src="imgs/logo.png" class="logo"></a>
            
        </div>
    </div>
    <div class="registerbox">
        <h1>Insert New Tutorial</h1>
        
            <p>Past Link Here</p>
            <input type="text" name="link" id="link" placeholder="Link" onkeyup="check_username();">
			
            
            <input type="submit" name="" value="Inset Video">
    </div>
</form>  
</body>
</html>