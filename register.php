<?php
require_once "connection.php";
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstn']) && isset($_POST['lastn'])){
$u = $_POST['username'];
$p = $_POST['password'];
$p2 = $_POST['password2'];
$f= $_POST['firstn'];
$l=$_POST['lastn'];
$r=1;
$errors= array();
if ($p != $p2){
	array_push($errors, "two passwords dont match the sane password");
}
if(count($errors)==0){
$Querry="INSERT INTO `member`(`username`, `password`, `fname`, `lname`, `role`) VALUES ('$u','$p','$f','$l', 1)";
$result = mysqli_query($connection, $Querry);

					if ($result ==1) {
						echo "New record created successfully";
					} else {
						echo "Error: " . $result . "<br>" . mysqli_error($connection);
					}

header('Location: login.php');
if ($result==FALSE) echo ("error description: " .mysqli_error($connection));

}
}
?>

<!DOCTYPE html>
<html>
	
<head>
    <title>Zero Gravity</title>
	<script>
  var is_username_ok=0;
                var is_password_strong=0;
                var does_password_match=0;


	function check_username(){
			var uname= document.getElementById("username").value;//get value of user
			
			var m= document.getElementById("username_message");
				if(uname==""){
			
					is_username_ok=0;
					m.style.color="red";
					m.innerHTML="Username is empty!";
			
				}
				else{
					is_username_ok=1;
					m.innerHTML="";
				}
			}


  function check_pass_strength(){
                var p=document.getElementById("firstpass").value;
                var m=document.getElementById("shortpassmessage");
                
                if (p==""){
                    m.style.color="red";
                    m.innerHTML="Password is empty!";
                    is_password_strong=0;
                }else{ //First pass is not empty
                  if (p.match(/^(?=.{6})(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])/)==null){
                // if (p.search(/^(?=.{6})(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])/)===-1){
                      m.style.color="red";      
                      m.innerHTML="Weak passowrd";
                      is_password_strong=0;
                  }else{
                      m.innerHTML="";
                      is_password_strong=1;
                  }
                  
        
        }     
      }
function check_pass_match(){
                var first_password=document.getElementById("firstpass").value;
                var second_password=document.getElementById("secondpass").value;
                var m=document.getElementById("second_pass_message");
                if (first_password!==second_password){ //no matching
                     m.style.color="red";      
                     m.innerHTML="Passwords don't match!";
                     does_password_match=0;
                }else{ // equal
                    
                   
                         if (second_password!=="" ) { //matching and not empty
                             m.innerHTML=""; 
                             does_password_match=1;
                         } else{
							m.style.color="red";             
							m.innerHTML="confirm password is empty!";
							does_password_match=0;
                              
                         }   
                }
          
      }


		function validate_form(){

check_username();
check_pass_strength();
check_pass_match();


if(is_username_ok && is_password_strong && does_password_match){
   alert("Created sucessfully");
   return true;

}else{
 alert("Fix your form");
 return false;
}
}

function myFunction() {
	var x = document.getElementById("firstpass");
	if (x.type === "password"){
		x.type = "text";

	}
	else{
		x.type = "password";
	}
}
		</script>



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
<form action ="register.php" method="POST" id= "myform" onsubmit="return validate_form();">
    <div class="lbar">
        <div class="lnavr">
        <a href="#" onclick="window.history.back()" ><img src="imgs/logo.png" class="logo"></a>
            
        </div>
    </div>
    <div class="registerbox">
        <h1>Register Here</h1>
        
            <p>Username</p>
            <input type="text" name="username" id="username" placeholder="Enter Username" onkeyup="check_username();">
			<p id="username_message" ></p></br>
            <p>Password</p>
            <input type="password" name="password" id="firstpass" placeholder="Enter Password" onkeyup="check_pass_strength()"></br>Show password
			<input type="checkbox" onclick="myFunction()"></br>
			<p id="shortpassmessage" ></p>

			<p>Confirm Password</p>
			<input type="password" name="password2" id="secondpass" placeholder="Confirm Password" onblur="check_pass_match()">
			<p  id="second_pass_message" ></p></br>
			<p>First Name</p>
            <input type="text" name="firstn" placeholder="Enter your First Name">
			<p>Last Name</p>
            <input type="text" name="lastn" placeholder="Enter you Last Name">
            <input type="submit" name="" value="Create Account">
    </div>
</form>  
</body>
</html>