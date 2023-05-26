<!DOCTYPE html>
<html>
<head>
    <title>Zero Gravity</title>
    <style>
    *{
        margin: 0;
        padding: 0;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .abba{
	width: 100%;
	height: 100vh;
	background-image:url(imgs/Aboutus.jpg);
	background-size: cover;
	background-position: center;
}
.abnav{
	width: 85%;
	margin: auto;
	padding: 35px 0;
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.logo{
	width: 250px;
	cursor: pointer;
}
.abnav ul li{
	list-style: none;
	display: inline-block;
	margin: 0 20px;
	position: relative;
}
.abnav ul li a{
	text-decoration: none;
	font-size: 16pt;
	color: #fff;
	text-transform: uppercase;}

.abnav ul li::after{
	content: '';
	height: 3px;
	width: 0;
	background: #2e73ce;
	position: absolute;
	left: 0;
	bottom: -10px;
	transition: 0.5s;
}
.abnav ul li:hover:after{
	width: 100%;
}
.abcontent{
    width: 65%;
	height:60vh;
	background:transparent;
	background-image: linear-gradient(rgba(46, 115, 206, 0.666),rgba(46, 115, 206, 0.777));
	top: 50%;
	left: 50%;
	position: absolute;
	transform: translate(-50%,-50%);
	box-sizing: border-box;
	padding: 70px 30px;
	border: 2px solid #2e73ce;
	border-radius: 25px;
    text-align: center;
    
}
.abcontent h1{
	font-size: 5vh;
	margin-top: 0.1vh;
	margin-bottom: 0.001vh;
    color: #ffffff;
    text-shadow: 2px 2px 2px #000;
}
.abcontent p{
	font-size: 2.5vh;
	margin: 10%;
	margin-bottom: 20%;
	font-weight: lighter;
	padding: 0.01vh;
    color: #ffffff;
    text-shadow: 2px 2px 2px #000;
	text-align: justify center;
}
    </style>
</head>
<body>
    <div class="abba">
        <div class="abnav">
		<a href="#" onclick="window.history.back()" ><img src="imgs/logo.png" class="logo"></a>
        </div>
    </div>
    <div class="abcontent">
        <h1>
           NO JUDGMENTS
        </h1>
        <p>Some may call it a tagline, but for us, it's a way of life.<br>
            It's our Monday-thru-every-day mantra.<br>
            An unfiltered philosophy that drives us to create a community and a gym for all.<br>
            No judgments means room for everyone, regardless of shape, size, age, race, gender or fitness level.<br>
            No matter your workout of choice, we want you to feel good while reaching your goals.<br>
             Join the fun.</p>
    
    </div>
</body>
</html>