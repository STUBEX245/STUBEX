<?php

include '../config.php';
session_start();
$email = $_SESSION['email'];

$sqli = "SELECT COUNT(*) AS countquantity FROM cart WHERE email='$email'";

$duration = $conn->query($sqli);
$record = $duration->fetch_array();
$totalquantity = $record['countquantity'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>STUBEX - Order List</title>
    <link rel="icon" href="../images/logo/icon1.png" sizes="32x32" type="image/png" sizes="50x50">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/menu.css">
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

/*button*/
.center {
    margin: auto;
    width: 60%;
    }

    .btn-group button {
    background-color: #f5a623; /* Green background */
    border: 1px solid #c4851c; /* Green border */
    color: white; /* White text */
    margin:0px 0px 5px -5px;
    cursor: pointer; /* Pointer/hand icon */
    width:150px;
    height:50px;
    }

</style>    
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
        <div class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <a href="sellerMain.php">Switch To Seller</a>
                <a href="buyerMain.php">Home</a>
                <a href="product.php">Product</a>
                <a href="order.php">Order</a>
                <a href="#">Chat</a>
                <a href="userProfile.php">Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

<div class="center">
  <div class="btn-group">
    <button onclick="location.href='order.php'">All Order</button>
    <button onclick="location.href='order_pending.php'">Pending Order</button>
    <button onclick="location.href='order_to_received.php'">To-Received Order</button>
    <button onclick="location.href='order_completed.php'">Completed Order</button>
    <button onclick="location.href='order_cancelled.php'">Cancelled Order</button>
  </div>
</div>
        <div class="chris" style="margin: 30px 50px 50px 50px;">
        
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Transaction ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $email = $_SESSION['email'];
            $query = "SELECT * FROM order_list WHERE custemail = '$email' ORDER BY time DESC";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)){
            $time=$row['time'];
            $transaction_id=$row['transaction_id'];
            $image=$row['image'];
			      $title=$row['title'];
            $price=$row['price'];
		        $quantity=$row['quantity'];
            $totalPrice=$row['totalPrice'];
            $delivery_address=$row['delivery_address'];
            $zip=$row['zip'];
            $state=$row['state'];
            $area=$row['area'];
            $order_status=$row['order_status'];
            $payment_status=$row['payment_status'];
        ?>
            <tr style="text-align:center;">
                <td><?php echo $row['time'];?></td>
                <td><?php echo $row['transaction_id'];?></td>
                <td style="width:120px;height=100px;"><img src="../images/<?php echo $image ?>" width="100%"></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['quantity'];?></td>
                <td><?php echo $row['totalPrice'];?></td>
                <td><?php echo $row['order_status'];?></td>
                <td>
                <?php if ($row['order_status']=='Pending'){ ?>
                <form action ="order.php" method ="POST">
                    <input type = "hidden" name="transaction_id" value = "<?php echo $row['transaction_id'];?>"/>
                    <input style="background-color: red;
  border-radius: 25px;
  width:75px;
  border: none;
  color: white;
  padding: 15px 30px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  cursor: pointer;" onclick="return confirm('Are you sure to cancel the order ?');" type="submit" name="update" id="update" value="X"/>
  </form>
  <?php } ?>

                </td>
            </tr>
           <?php
            }
           ?>
        </tbody>
        <tfoot>
            <tr>
              <th>Date & Time</th>
                <th>Transaction ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
  </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>


</body>
<script>
const doc = document;
const menuOpen = doc.querySelector(".menu");
const menuClose = doc.querySelector(".close");
const overlay = doc.querySelector(".overlay");

menuOpen.addEventListener("click", () => {
  overlay.classList.add("overlay--active");
});

menuClose.addEventListener("click", () => {
  overlay.classList.remove("overlay--active");
});

</script>
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myFLOW");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  if (current.length > 0) { 
    current[0].className = current[0].className.replace(" active", "");
  }
  this.className += " active";
  });
}
</script>
<?php

if(isset($_POST['update'])){
    $transaction_id = $_POST['transaction_id'];

    $select = "UPDATE order_list SET order_status='Cancelled' WHERE transaction_id = '$transaction_id'";
    $result = mysqli_query($conn, $select);

    echo '<script type = "text/javascript">';
    echo 'window.location.href = window.location.href;';
    echo '</script>';
}
?>
</html>