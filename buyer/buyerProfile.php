<?php 
include '../config.php';
session_start();
$email = $_SESSION['email'];

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

    $sqli = "SELECT COUNT(*) AS countquantity FROM cart WHERE email='$email'";

    $duration = $conn->query($sqli);
    $record = $duration->fetch_array();
    $totalquantity = $record['countquantity'];

    $sqli = "SELECT * FROM users WHERE email = '$email'";
    $result1 = mysqli_query($conn,$sqli);
    if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
    $username = $row["username"];
    $address = $row["address"];
    $zip = $row["zip"];
    $state = $row["state"];
    $area = $row["area"];
    $phone_number = $row["phone_number"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>STUBEX - My Profile</title>
    <link rel="icon" href="../images/logo/icon1.png" sizes="32x32" type="image/png" sizes="50x50">
    <link rel="stylesheet" href="../css/toastr.min.css">
    <script src="../javascript/jquery-3.3.1.min.js"></script>
    <script src="../javascript/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>

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
    </style>
	<link rel="stylesheet" href="../css/menu.css">
	<link rel="stylesheet" href="../css/login.css">
	<link rel="stylesheet" href="../css/register.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
    <header class="header">
    <a href="../buyer/buyerMain.php" class="logo"><img src="../images/logo/logo01.png" height="50px" alt=""></a>
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

<div class="page-content">
		<div class="form-v10-content" style="margin-bottom:49px;">
			<form class="form-detail" action="" method="post">
				<div class="form-left">
					<h2>User Infomation</h2>
					<div class="form-row">
						<input type="text" name="username" id="username" class="input-text" value="<?php echo $username; ?>" placeholder="Username" required>
					</div>
					<div class="form-row">
						<input type="email" name="email" id="email" class="input-text" value="<?php echo $_SESSION['email']; ?>" placeholder="Email" readonly>
					</div>
                    <div class="form-row">
                        <button type="button" style="margin-top:30px;
  border: none;
  color: white;
  padding: 15px 32px;
  background: #4e657a;
	border-radius: 25px;
	-o-border-radius: 25px;
	-ms-border-radius: 25px;
	-moz-border-radius: 25px;
	-webkit-border-radius: 25px;
	width: 180px;
	border: none;
	margin: 30px 0 50px 0px;
	cursor: pointer;
	color: white;
	font-weight: 700;
	font-size: 15px;" onclick="document.location='address.php'">Addresses</button>
					</div>
                    <?php
                           }
                                }
                    ?>
					
				</div>
				<div class="form-right">
					<h2>Change Password</h2>
                    <div class="form-row">
						<input type="password" name="oldpassword" class="company" id="oldpassword" placeholder="Old Password" >
					</div>
					<div class="form-row">
						<input type="password" name="npassword" class="company" id="npassword" placeholder="New Password" >
					</div>
                    <div class="form-row">
						<input type="password" name="cnpassword" class="company" id="cnpassword" placeholder="Confirm New Password" >
					</div>
					<div class="form-row-last">
						<input type="submit" name="update" class="register" value="Save Changes">
					</div>
				</div>
			</form>
		</div>
	</div>
    
<footer>
  <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script>, Used Book Buy and Sell Platfrom</p>
</footer>
</body>
 
</html>
<?php
if (isset($_POST['update'])){
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $username1 = $_POST['username'];
    $oldpassword=md5($_POST['oldpassword']);
    $npassword=md5($_POST['npassword']);
    $cnpassword=md5($_POST['cnpassword']);

    if((empty($_POST['npassword']))&&(empty($_POST['cnpassword']))){
        $sql = "UPDATE users SET username ='$username1' WHERE email='$email'";
    }

    if($oldpassword == $password){
        if($npassword == $cnpassword){
                  $sql = "UPDATE users SET password = '$cnpassword', username ='$username1' WHERE email='$email'";
                  $result = mysqli_query($conn,$sql);
                  if($result){
                      $_SESSION['password'] = $oldpassword;
                      echo '<script type="text/javascript">toastr.success("Password Changed!")</script>';
                  }
                  else{
                      echo '<script type="text/javascript">toastr.error("Password Not Changed!")</script>';
                  }
        }else{
            echo '<script type="text/javascript">toastr.error("Password Not Matched!")</script>';
        }
    }else{
        echo '<script type="text/javascript">toastr.error("Old Password Not Matched!")</script>';
    }
}
?>