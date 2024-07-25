<?php
include('../config.php');

session_start();
$email = $_SESSION['email'];

if(isset($_GET['delete'])){

	$delete=$_GET['delete'];
	$sql="delete from cart where id='$delete' AND email='$email'";
	$result=$conn->query($sql);
}


    $sql="select * from cart WHERE email='$email'";
    $result=$conn->query($sql);

?>


<?php
    $sql_qry = "SELECT SUM(totalPrice) AS count FROM cart WHERE totalPrice AND email='$email'";

    $duration = $conn->query($sql_qry);
    $record = $duration->fetch_array();
    $total = $record['count'];
	?>

<?php
    $sqli = "SELECT COUNT(*) AS countquantity FROM cart WHERE email='$email'";

    $duration = $conn->query($sqli);
    $record = $duration->fetch_array();
    $totalquantity = $record['countquantity'];
	?>

<html>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<title>STUBEX - Checkout</title>
<link rel="icon" href="../images/logo/icon1.png" sizes="32x32" type="image/png" sizes="50x50">
<style>
/* 64ac15 */
*,
*:before,
*:after {
  box-sizing: border-box;
}
body {

  font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 15px;
  color: #b9b9b9;
  background-color: #e3e3e3;
}
h4, h1 {
  /* color: #f0a500; */
}
a {
  color: inherit;
  text-decoration: none;
}
li {
  list-style: none;
}
.good{
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 1rem 0 3rem 0;
}
.good li{
    margin: 0 10px;
}
.good a{
    text-decoration: none;
    color: #f5a623;
}

.good a:hover {
    color: #f5a623;
}

input,
input[type="radio"] + label,
input[type="checkbox"] + label:before,
select option,
textarea,
select {
  width: 100%;
  padding: 1em;
  line-height: 1.4;
  background-color: white;
  border: 1px solid #e5e5e5;
  border-radius: 3px;
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}


input[type="radio"] {
  display: none;
}
input[type="radio"] + label,
select {
  display: inline-block;
  width: 50%;
  text-align: center;
  float: left;
  border-radius: 0;
}
input[type="radio"] + label:first-of-type {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
input[type="radio"] + label:last-of-type {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
input[type="radio"] + label i {
  padding-right: 0.4em;
}
input[type="radio"]:checked + label,
input:checked + label:before,
select:focus,
select:active {
  /* background-color: #f0a500; */
  color: #f5a623;
}
textarea{
resize: none;
width:100%;
height:100px;
}
input[type="checkbox"] {
  display: none;
}
input[type="checkbox"] + label {
  position: relative;
  display: block;
  padding-left: 1.6em;
}
input[type="checkbox"] + label:before {
  position: absolute;
  top: 0.2em;
  left: 0;
  display: block;
  width: 1em;
  height: 1em;
  padding: 0;
  content: "";
}
input[type="checkbox"] + label:after {
  position: absolute;
  top: 0.45em;
  left: 0.2em;
  font-size: 0.8em;
  color: #f5a623;
  opacity: 0;
  font-family: FontAwesome;
  content: "\f00c";
}
input:checked + label:after {
  opacity: 1;
}
select {
  height: 3.4em;
  line-height: 2;
}
select:first-of-type {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
select:last-of-type {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
select:focus,
select:active {
  outline: 0;
}
select option {
  /* background-color: #f0a500; */
  color: #f5a623;
}
.input-group, textarea {
  margin-bottom: 1em;
  zoom: 1;
}
.input-group:before,
.input-group:after {
  content: "";
  display: table;
}
.input-group:after {
  clear: both;
}
.input-group-icon, textarea {
  position: relative;
}
.input-group-icon input, textarea {
  padding-left: 4.4em;
}
.input-group-icon .input-icon {
  position: absolute;
  top: 0;
  left: 0;
  width: 3.4em;
  height: 3.4em;
  line-height: 3.4em;
  text-align: center;
  pointer-events: none;
}
.input-group-icon .input-icon:after {
  position: absolute;
  top: 0.6em;
  bottom: 0.6em;
  left: 3.4em;
  display: block;
  border-right: 1px solid #f5a623;
  content: "";
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
.input-group-icon .input-icon i{
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
.container {
  max-width: 38em;
  padding: 1em 3em 2em 3em;
  margin: 0em auto;
  background-color: #fff;
  border-radius: 4.2px;
  box-shadow: 0px 3px 10px -2px #f5a623;
}
.row {
  zoom: 1;
}
.row:before,
.row:after {
  content: "";
  display: table;
}
.row:after {
  clear: both;
}
.col-half {
  padding-right: 10px;
  float: left;
  width: 50%;
}
.col-half:last-of-type {
  padding-right: 0;
}
.col-third {
  padding-right: 10px;
  float: left;
  width: 33.33333333%;
}
.col-third:last-of-type {
  padding-right: 0;
}
/* Style the buttons */
.btn {
        border: none;
        outline: none;
        padding: 10px 16px;
        color:white;
        background-color: #f5a623;
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
  background-color: #f5a623;
}
@media only screen and (max-width: 540px) {
  .col-half {
    width: 100%;
    padding-right: 0;
  }
}

</style>
<link rel="stylesheet" href="../css/menu.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
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
<div class="container" style="margin-top:50px;">
    <div class="row">
      <h4 style="margin-bottom:10px;text-align: center;color:#f5a623;">Your Shipping Address </h4>

<div class="input-group input-group">

<form action="codsuccess.php"  method="POST">
  <select name="cars" id="cars" style="width:100%">
  <?php
  $sqlim = "SELECT * FROM address WHERE email = '$email'";
        $result1 = mysqli_query($conn,$sqlim);
        if (mysqli_num_rows($result1) > 0) {
        while($row = mysqli_fetch_assoc($result1)) {
        $home_address = $row["home_address"];
        $zip = $row["zip"];
        $state = $row["state"];
        $area = $row["area"];
        $phone_number = $row["phone_number"];
        $delivery_address = "$home_address".', '."$zip".', '."$state".', '."$area".', '."$phone_number";
        ?>
  <option><?php echo $delivery_address ?></option>
  <?php
        }
    }
  ?>
  </select>
  <div>
        <input style="color:#f0a500;"  type="radio" name="payment-method" value="card" checked="true"/>
        <label style="height:70px;"><input style="background-color:#f0a500;
  width:200px;
  color: white;
  text-align: center;
  text-decoration: none;
  font-size: 13px;
  cursor: pointer;border:none;"  value="Add New Address" onclick="location.href='address.php';"/></label>
   <input  type="radio" name="payment-method" value="card" checked="true"/>
        <label style="height:70px;"><input style="background-color:#f0a500;
  width:200px;
  color: white;
  text-align: center;
  text-decoration: none;
  font-size: 13px;
  cursor: pointer;border:none;" type="submit" name="address" id="address" value="Cash On Delivery"/></label>
      </div>
  </form>
      </div>
      <!-- <form action="codsuccess1.php" method="POST">
      <div class="input-group input-group-icon" style="display:none;">
        <input style="display:none;" type="text" id="delivery_address" name="delivery_address" value="<?php echo $home_address ?>" placeholder="Zip Code" required/>
        <div class="input-icon"><i class="fa fa-envelop"></i></div>
      </div>
      <div class="input-group input-group-icon" style="display:none;">
        <input style="display:none;" type="number" id="zip" name="zip" value="<?php echo $zip ?>" placeholder="Zip Code" required/>
        <div class="input-icon"><i class="fa fa-envelop"></i></div>
      </div>
      <div class="input-group input-group-icon" style="display:none;">
        <input style="display:none;" type="text" id="state" name="state" value="<?php echo $state ?>" placeholder="State" required/>
        <div class="input-icon"><i class="fa fa-ke"></i></div>
      </div>
	<div class="input-group input-group-icon" style="display:none;">
        <input type="text" id="area" name="area" value="<?php echo $area; ?>" placeholder="Area" required/>
        <div class="input-icon"><i class="fa fa-ke"></i></div>
      </div>
    </div>
    <div class="row">
      <div class="col-half">
        
    </div> -->
    <div class="row">
      <h4 style="margin-bottom:10px;text-align: center;color:#f5a623;">Other Payment Method</h4>
      <div class="input-group" style="margin-left: 150px;">

  
        <input id="payment-method-paypal" name="payment-method-paypal" type="radio" name="payment-method" value="paypal"/>
        <label for="payment-method-paypal" name="payment-method-paypal"><span name="payment-method-paypal" id="paypal-button"></span></label>
      </div>
      <div class="row">
      <div class="input-group">
      <?php
        $sql5 = "SELECT COUNT(*) AS durant FROM (SELECT COUNT(seller_id) FROM cart WHERE email='$email' GROUP BY seller_id HAVING COUNT(seller_id) >= 1) AS durant;";
        $duration5 = $conn->query($sql5);
        $record5 = $duration5->fetch_array();
        $totalquantity5 = $record5['durant'];
?>
        <h1 style="text-align:center;color:#f5a623;">Total Price : RM <?php echo $total + ($totalquantity5 * 5) ?></h1>
      </div>
    </div>
  </form>
</div>
</div>
</div>
</body>
<script>
paypal.Button.render({
  env: 'sandbox', // change for production if app is live,
        //app's client id's

	client: {
        sandbox:    'AfEH5y7-w6dbaEhi6NrsuCh2FyW9FK6n1vSdAxtPVVvBKPnsLjn--6xhQswGoqP7Ymxgq7ruzacrmvYN',
        // AdDNu0ZwC3bqzdjiiQlmQ4BRJsOarwyMVD_L4YQPrQm4ASuBg4bV5ZoH-uveg8K_l9JLCmipuiKt4fxn
        //production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },
 
    commit: true, // Show a 'Pay Now' button
 
    style: {
    	color: 'blue',
    	size: 'small'
    },
 
    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                    	//total purchase
                        amount: { 
                        	total: '<?php echo $total; ?>', 
                        	currency: 'MYR' 
                        }
                    }
                ]
            }
        });
    },
 
  onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
           alert('Transaction completed by ' + details.payer.name.given_name);
               window.location.replace("paymentsuccess.php");
        })
    }, 
}, '#paypal-button');
</script>

<!-- <script>
function ajax_post(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "paymentsuccess.php";
    var fn = document.getElementById("delivery_address").value;
    var ln = document.getElementById("zip").value;
    var vars = "firstname="+fn+"&lastname="+ln;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("status").innerHTML = return_data;
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(vars); // Actually execute the request
    document.getElementById("status").innerHTML = "processing...";
}
</script> -->
</html>
<?php

if(isset($_POST['address'])){
    $ikey = $_POST['ikey'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $select = "UPDATE cart SET quantity=$quantity,totalPrice= $quantity * $price  WHERE ikey = '$ikey'";
    $result = mysqli_query($conn, $select);

    echo '<script type = "text/javascript">';
    echo 'window.location.href = "cart.php"';
    echo '</script>';
}
?>