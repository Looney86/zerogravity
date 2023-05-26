<?php
	session_start();
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error="Username or Password empty";
	}else{
        $u= $_POST['username'];
$password = $_POST['password'];
require_once "connection.php";


$query = "SELECT * FROM `member` WHERE username='$u' AND password ='$password'";
$result= mysqli_query($connection, $query);
$rows=mysqli_num_rows($result);
if ($rows == 1) { //the sign in is succefull, matching is correct
   
    $r =  mysqli_fetch_array($result);
    $role = $r['role'];
    if($role == 1 ) {//this is a user
       
		$_SESSION['user_id'] = $r['id'];
      $_SESSION['isloggedin']=1;
        $_SESSION['u']=$u;
		header("location:userhome.php?u=".$username);
    }
        else if ($role == 2) {
            $_SESSION['isloggedin']=1;
			$_SESSION['u']=$u;
            header("location: adminhome.php?u=".$username);
        


} }else 
{//matching is not correct
    $error = "Username or Password is invalid";
	$message[] = 'incorrect email or password!';
    header("location:login.php");
}
mysqli_close($connection); // Closing Connection
}
}

?>


<html>
<head>
    <title>Zero Gravity</title>
    <style>
  *{
	margin: 0;
	padding: 0;
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
.lba{
	width: 100%;
	height: 100vh;
	background-image:url(imgs/Login.png);
	background-size: cover;
	background-position: center;
}
.lnav{
	width: 85%;
	margin: auto;
	padding: 35px 0;
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.loginbox{
	width: 30%;
	height: 100%;
	background:transparent;
	background-image: linear-gradient(rgba(46, 115, 206, 0.666),rgba(46, 115, 206, 0.777));
	top: 50%;
	left: 50%;
	position: absolute;
	transform: translate(-50%,-50%);
	box-sizing: border-box;
	padding: 70px 30px;
	
	
}
.loginbox h1{
	margin: o;
	padding: 0 0 20px;
	text-align: center;
	font-size: 22px;
	color: #fff;
}
.loginbox p{
	margin: 0;
	padding: 0;
	font-weight: bold;
	color: #fff;
}
.loginbox input{
	width: 100%;
	margin-bottom: 20px;
}
.loginbox input[type="text"], input[type="password"]{
	border: none;
	border-bottom: 1px solid #fff;
	background: transparent;
	outline: none;
	height: 40px;
	color: aliceblue;
	font-size: 16px;
	text-shadow: 1px 1px 1px #000;
}
.loginbox input[type="submit"]{
	border: none;
	outline: none;
	height: 38px;
	background: aliceblue;
	color: #000;
	font-size: 18px;
	border-radius: 20px;
}
.loginbox input[type="submit"]:hover{
	cursor: pointer;
	background: #2e73ce;
	color: aqua;
}

</style>

</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
    <div class="lba">
        <div class="lnav">
		<a href="#" onclick="window.history.back()" ><img src="imgs/logo.png" class="logo"></a>
        </div>
    </div>
    <div class="loginbox">
        <h1>Login Here</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return validate_form();">
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Enter Username"  onkeyup="check_username();">
			<p id="username_message" ></p></br>
            <p>Password</p>
            <input type="password" name="password" id="password" placeholder="Enter Password" onkeyup="check_password();">
			<p id="password_message" ></p></br>
            <input name="submit" type="submit" name="" value="Login" >
            <a href="Register.php">Don't Have an Account</a>
        </form>
    </div>
    
</body>
</html>