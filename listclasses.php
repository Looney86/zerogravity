<HTML>
<title>Zero Gravity</title>

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

table{
	background-color: #f2f2f2;
	background:transparent;
	background-image: linear-gradient(rgba(46, 115, 206, 0.666),rgba(46, 115, 206, 0.777));
	color: #333;
	border-radius: 20px;
	border: 0px;
	top: 50%;
	left: 50%;
	position: absolute;
	text-align: center;
	transform: translate(-50%,-50%);
	box-sizing: border-box;
	padding: 70px 30px;
	border: 2px solid #2e73ce;
	border-radius: 25px;
	font-size:140%;
	text-shadow: 0.5px 0.5px 0.5px #000;
	

}
h2 {
  font-size: 250%;
  color: rgba(46, 115, 206, 0.666);
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  text-shadow: 1px 1px 1px #000;
  font-style: italic;
}
</style>
</head>
<body>
 
    <div class="lba">
        <div class="lnav">
		<a href="#" onclick="window.history.back()" ><img src="imgs/logo.png" class="logo"></a>
        </div>
		<div class="c1">
  <h2>TAKE A LOOK AT OUR CLASS SCHEDULE<h2>
</div>
		<?php

$con= mysqli_connect("localhost","root","","zerogravity");

if (mysqli_connect_errno()){
	echo "failed to connect to the database". mysqli_connect_error();
	}
	#else echo "you are connected";#
	$query = "SELECT session.name AS session_name, days.name AS days_name, coach.name AS coach_name, slot.start, slot.end, category.name AS category_name
	from session_details 
	LEFT JOIN session ON session_details.id = session.id 
	LEFT JOIN days ON session_details.day = days.id 
	LEFT JOIN coach ON session_details.coach = coach.id 
	LEFT JOIN slot ON session_details.time = slot.id 
	LEFT JOIN category ON session_details.category = category.id;";
	$result = mysqli_query($con,$query);
	
	
	echo "<TABLE border=3 align=center cellpadding=5 cellspacing=5>";
	echo "<tr>";
    echo "<th>Session Name</th>";
    echo"<th>Day</th>";
    echo"<th>Coach</th>";
	echo"<th>Start Time</th>";
	echo"<th>End Time</th>";
	echo"<th>Category</th>";
 echo" </tr>";
while ($row = mysqli_fetch_array($result)){
	
	echo "<TR>";
	echo "<TD>".$row['session_name']."</TD>";
	echo "<TD>".$row['days_name']."</TD>";
	echo "<TD>".$row['coach_name']."</TD>";
	echo "<TD>".$row['start']."</TD>";
	echo "<TD>".$row['end']."</TD>";
	echo "<TD>".$row['category_name']."</TD>";
	echo "</TR>";
	
	
	
	}
	mysqli_close($con);


?>
    
	</div>


	</body>
	









