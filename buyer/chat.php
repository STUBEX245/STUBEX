<?php
    include '../config.php';
    session_start();
    $email = $_SESSION['email'];

     $sqli = "SELECT COUNT(*) AS countquantity FROM cart WHERE email='$email'";

     $duration = $conn->query($sqli);
     $record = $duration->fetch_array();
     $totalquantity = $record['countquantity'];

	 if(isset($_GET['pid'])){//if received pid from other page
		$pid=$_GET['pid'];
		$to_id=$pid;
		$sql="SELECT * FROM product WHERE seller_id='$to_id'";
		$result=$conn->query($sql);
	}

	$sql56 = "SELECT * FROM conversations WHERE user_1='$email' or user_2='$email'";
	$result56=$conn->query($sql56);

	$keyword="";
	if(isset($_POST['search_id'])){
    $keyword=$_POST['search_id'];
    $sql56="SELECT * FROM conversations WHERE (user_1 like '%$keyword%' and user_2 like '$email') or (user_1 like '$email' and user_2 like '%$keyword%')";
    $result56=$conn->query($sql56);
}

?>

<?php
if(isset($_POST['send_message'])){
	$from_id = $_SESSION['email'];
	$message = $_POST['message'];
  
	$query1="INSERT INTO chats SET from_id='$from_id',to_id='$to_id',message='$message'";
	$result1 = mysqli_query($conn, $query1);

	$query4 = "SELECT * FROM conversations WHERE (user_1='$from_id' OR user_1='$to_id') AND (user_2='$from_id' OR user_2='$to_id')";
	$result4 = mysqli_query($conn, $query4);

		if($row = mysqli_fetch_array($result4)){
		{
			
		}
  }
  else{
	$query2="INSERT INTO conversations SET user_1='$from_id',user_2='$to_id'";
	$result2 = mysqli_query($conn, $query2);}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>STUBEX - Messenger</title>
		<link rel="icon" href="../images/logo/icon1.png" sizes="32x32" type="image/png" sizes="50x50">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
	</head>
<style>
    
* {
	margin: 0;
	padding: 0;
	font-family: 'Roboto', sans-serif;
}

body {
  background:#4e657a;
  background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
  background-attachment: fixed;
  width: 100%;
	height: 100vh;
}

		
		.card{
			height: 500px;
			border-radius: 15px !important;
			background-color: rgba(0,0,0,0.4) !important;
		}
		.contacts_body{
			padding:  0.75rem 0 !important;
			overflow-y: auto;
			white-space: nowrap;
		}
		.msg_card_body{
			overflow-y: auto;
		}
		.card-header{
			border-radius: 15px 15px 0 0 !important;
			border-bottom: 0 !important;
		}
	 .card-footer{
		border-radius: 0 0 15px 15px !important;
			border-top: 0 !important;
	}
		.container{
			align-content: center;
		}
		.search{
			border-radius: 15px 0 0 15px !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
		}
		.search:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.type_msg{
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
			height: 60px !important;
			overflow-y: auto;
		}
			.type_msg:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.attach_btn{
	border-radius: 15px 0 0 15px !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.send_btn{
	border-radius: 0 15px 15px 0 !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.search_btn{
			border-radius: 0 15px 15px 0 !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.contacts{
			list-style: none;
			padding: 0;
		}
		.contacts li{
			width: 100% !important;
			padding: 5px 10px;
			margin-bottom: 15px !important;
		}
	.active{
			background-color: rgba(0,0,0,0.3);
	}
		.user_img{
			height: 70px;
			width: 70px;
			border:1.5px solid #f5f6fa;
		
		}
		.user_img_msg{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;
		
		}
	.img_cont{
			position: relative;
			height: 70px;
			width: 70px;
	}
	.img_cont_msg{
			height: 40px;
			width: 40px;
	}
	.online_icon{
		position: absolute;
		height: 15px;
		width:15px;
		background-color: #4cd137;
		border-radius: 50%;
		bottom: 0.2em;
		right: 0.4em;
		border:1.5px solid white;
	}
	.offline{
		background-color: #c23616 !important;
	}
	.user_info{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 15px;
	}
	.user_info span{
		font-size: 20px;
		color: white;
	}
	.user_info p{
	font-size: 10px;
	color: rgba(255,255,255,0.6);
	}
	.video_cam{
		margin-left: 50px;
		margin-top: 5px;
	}
	.video_cam span{
		color: white;
		font-size: 20px;
		cursor: pointer;
		margin-right: 20px;
	}
	.msg_cotainer{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 10px;
		border-radius: 25px;
		background-color: #82ccdd;
		padding: 10px;
		position: relative;
	}
	.msg_cotainer_send{
		margin-top: auto;
		margin-bottom: auto;
		margin-right: 10px;
		border-radius: 25px;
		background-color: #78e08f;
		padding: 10px;
		position: relative;
	}
	.msg_time{
		position: absolute;
		left: 0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.msg_time_send{
		position: absolute;
		right:0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.msg_head{
		position: relative;
	}
	#action_menu_btn{
		position: absolute;
		right: 10px;
		top: 10px;
		color: white;
		cursor: pointer;
		font-size: 20px;
	}
	.action_menu{
		z-index: 1;
		position: absolute;
		padding: 15px 0;
		background-color: rgba(0,0,0,0.5);
		color: white;
		border-radius: 15px;
		top: 30px;
		right: 15px;
		display: none;
	}
	.action_menu ul{
		list-style: none;
		padding: 0;
	margin: 0;
	}
	.action_menu ul li{
		width: 100%;
		padding: 10px 15px;
		margin-bottom: 5px;
	}
	.action_menu ul li i{
		padding-right: 10px;
	
	}
	.action_menu ul li:hover{
		cursor: pointer;
		background-color: rgba(0,0,0,0.2);
	}
	@media(max-width: 576px){
	.contacts_card{
		margin-bottom: 15px !important;
	}
	}
    a{
    text-decoration: none;
}


.logo{
	cursor: pointer;
}

.nav-area{
    list-style: none;
}

.nav-area li{
    display: inline-block;
    padding: 0 15px;
    text-transform: uppercase;
}
.nav-area li a{
    transition: .3s;
    color: #fff;
    text-decoration:none;
}

.nav-area li a:hover{
    color: #f5a623;
}

.btn-area{
    cursor: pointer;
    color: white;
    font-size: 16px;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 10px 30px;
    border-radius: 5px;
    background: #435c70;
}

.btn-area hover{
    background:#f5a623;
}

.mySlides1 {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container1 {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot1 {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}

.curry{
  background:#435c70;
  border-radius: 10px 10px 0 0;
}

.curry h1{
  color: white;
}

.center{
  margin:auto;
  width:400px;
  background: white;
  border-radius: 10px;
  box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
}
.center h1{
  text-align: center;
  padding: 20px 0;
  border-bottom: 1px solid silver;
}
.center form{
  padding: 0 40px;
  box-sizing: border-box;
}
form .txt_field{
  position: relative;
  border-bottom: 2px solid #adadad;
  margin: 30px 0;
}

.txt_field input{
  width: 100%;
  padding: 0 5px;
  height: 40px;
  font-size: 16px;
  border: none;
  background: none;
  outline: none;
}

.txt_field label{
  position: absolute;
  top: 50%;
  left: 5px;
  color: #adadad;
  transform: translateY(-50%);
  font-size: 16px;
  pointer-events: none;
  transition: .5s;
}

.txt_field span::before{
  content: '';
  position: absolute;
  top: 40px;
  left: 0;
  width: 0%;
  height: 2px;
  background: #435c70;
  transition: .5s;
}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label{
  top: -5px;
  color: #435c70;
}
.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before{
  width: 100%;
}

.pass{
  margin: -5px 0 20px 5px;
  color: #a6a6a6;
  cursor: pointer;
}
.pass:hover{
  text-decoration: underline;
}
input[type="submit"]{
  width: 100%;
  height: 50px;
  border: 1px solid;
  background: #435c70;
  border-radius: 25px;
  font-size: 18px;
  color: #e9f4fb;
  font-weight: 700;
  cursor: pointer;
  outline: none;
}
input[type="submit"]:hover{
  border-color: #f5a623;
  transition: .5s;
}
.signup_link{
  margin: 30px 0;
  padding: 10px 0;
  text-align: center;
  font-size: 16px;
  color: #666666;
}
.signup_link a{
  color: #435c70;
  text-decoration: none;
}
.signup_link a:hover{
  text-decoration: underline;
}


@media screen and (max-width: 575px) {
	.form-v10-content .form-detail .form-group {
		flex-direction:  column;
		-o-flex-direction:  column;
		-ms-flex-direction:  column;
		-moz-flex-direction:  column;
		-webkit-flex-direction:  column;
	}
	.form-v10-content .form-detail .form-row,
	.form-v10-content .form-detail .form-left .form-group .form-row.form-row-1,
	.form-v10-content .form-detail .form-left .form-group .form-row.form-row-2,
	.form-v10-content .form-detail .form-left .form-group .form-row.form-row-3,
	.form-v10-content .form-detail .form-left .form-group .form-row.form-row-4,
	.form-v10-content .form-detail .form-right .form-group .form-row.form-row-1,
	.form-v10-content .form-detail .form-right .form-group .form-row.form-row-2 {
	    width: auto;
	    padding: 0 30px;
	}
	.form-v10-content .form-detail .select-btn,
	.form-v10-content .form-detail .form-left .form-group .form-row.form-row-4 .select-btn,
	.form-v10-content .form-detail .form-right .form-group .form-row.form-row-2 .select-btn {
		right: 15%;
	}
	.form-v10-content .form-detail h2 {
	    padding: 33px 30px 0px 30px;
	}
	.form-v10-content .form-detail .form-checkbox {
		padding: 0 30px;
	}
	.form-v10-content .form-detail .form-checkbox .checkmark {
		left: 30px;
	}
	.form-v10-content .form-detail .form-right .form-row-last {
		padding-left: 0;
		text-align: center;
	    margin: 44px 0 30px;
	}
}
        /* Style the buttons */
        .btn {
        border: none;
        outline: none;
        padding: 10px 16px;
        color:white;
        background-color: #435c70;
        cursor: pointer;
        font-size: 18px;
        }

        /* Style the active class, and buttons on mouse-over */
        .active, .btn:hover {
        background-color: #666;
        color: #f5a623;
        }
        #lblCartCount {
    font-size: 12px;
    background: #ff0000;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px;
}
.badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}

a:hover{
	color:white;
}
</style>
	<!--Coded With Love By Mutiullah Samim-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/menu.css">
	<body>
    <header class="header">
    <a href="../buyer/buyerMain.php" style="display: block;
  float: left;margin-left:20px;margin-top:10px"><img src="../images/logo/logo01.png" height="50px" alt=""></a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="nav-icon"></span></label>
<ul class="menu">
    <li><a href="../seller/sellerMain.php" style="color:#f5a623;font-weight:bold;">Seller Centre</a></li>
    <li><a href="buyerMain.php">Home</a></li>
    <li><a href="buyerProduct.php">Product</a></li>
<li><a href="order.php">Order</a></li>
<li><a href="buyerProfile.php">Profile</a></li>
<li><a href="about_us.php">About</a></li>
    <li style="list-style-type: none;"><a href="chat.php"><i class="fa fa-comment" style="font-size:15px;color:white;"></i></a></li>
    <li style="list-style-type: none;"><a href="cart.php"><i class="fa fa-shopping-cart" style="font-size:15px;color:white;"></i> <span class='badge badge-warning' id='lblCartCount'><?php echo $totalquantity ?></span></a></li>
<li><a href="../logout.php">Logout</a></li>
</ul>
</header>

		<div class="container-fluid h-100" >
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
						<form method="POST" action="chat.php">
							<input type="search" name="search_id" id="search_id" placeholder="Search..." name="" class="form-control search">
							<button style="display:none;" type="submit"></button>
						</form>
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"></span>
							</div>
						</div>
					</div>
					<div class="card-body contacts_body">
						<ui class="contacts">
						<?php
								if ($result56->num_rows > 0) {    
									while($row = $result56->fetch_assoc()) {
										$user_1=$row['user_1'];
										$user_2=$row['user_2'];
        				?>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="../images/logo/profile.png" class="rounded-circle user_img">
									<!-- <span class="online_icon"></span> -->
								</div>
								
								<div class="user_info">
									<span><a style="color:white;" href="chat.php?pid=<?php if($user_1!=$email){ echo $user_1;} else if($user_2!=$email){ echo $user_2; }?>"><?php if($user_1!=$email){ echo $user_1;} else if($user_2!=$email){ echo $user_2; }?></a></span>
									<!-- <p>Kalid is online</p> -->
								</div>
							</div>
						</li>

						<?php
								}
							}
						?>
						
						</ui>
					</div>
					<div class="card-footer"></div>
				</div></div>

				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
					<?php if(isset($_GET['pid'])){ ?>
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="../images/logo/profile.png" class="rounded-circle user_img">
									<!-- <span class="online_icon"></span> -->
								</div>
								<div class="user_info">
									<span>Chat with <?php echo $to_id; ?></span>
									<!-- <p>1767 Messages</p> -->
								</div>
								<!-- <div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div> -->
							</div>
							<!-- <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span> -->
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div>
						</div>

						<div class="card-body msg_card_body" id='messageBody'>
						<?php
							$email=$_SESSION['email'];
							$query = "SELECT * FROM chats WHERE (from_id = '$email' OR to_id = '$email') AND (from_id='$pid' OR to_id='$pid') ORDER BY created_at ASC";
							$result = mysqli_query($conn, $query);
								while($row = mysqli_fetch_array($result)){
									$from_id=$row['from_id'];
									$to_id=$row['to_id'];
									$message=$row['message'];
									$created_at=$row['created_at'];
        				?>
						<?php if($from_id != $_SESSION['email']) {?>
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="../images/logo/profile.png" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
								  <?php echo $message; ?>
									<!-- <span class="msg_time">8:40 AM, Today</span> -->
								</div>
							</div>
							<?php }else { ?>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
										<?php echo $message; ?>
									<!-- <span class="msg_time_send">8:40 AM, Today</span> -->
								</div>
								<div class="img_cont_msg">
							<img src="../images/logo/profile-green.png" class="rounded-circle user_img_msg">
								</div>
							</div>
							<?php
							}
            }
            ?>				
						</div>
						<form method="post" action="">
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<!-- <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span> -->
								</div>
										<textarea name="message" class="form-control type_msg" placeholder="Type your message..." required style="display: flex;"></textarea>
											<div class="input-group-append">
												<button type="submit" name="send_message" id="send_message" style="background-color:#232a36;"><i class="fas fa-location-arrow" style="margin:10px;color:white;"></i></button>
											</div>
									</form>
							</div>
						</div>
						<?php }else echo ""; ?>
					</div>
				</div>
			</div>
		</div>
	</body>
<footer>
  <p style="margin-top:12px;">Copyright &copy; <script>document.write(new Date().getFullYear());</script>, 2nd Hand Shopping Platfrom</p>
</footer>
</html>
<script>
var chatHistory = document.getElementById("messageBody");
chatHistory.scrollTop = chatHistory.scrollHeight;
</script>
