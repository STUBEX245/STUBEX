<?php
include('../config.php');
session_start();
$email = $_SESSION['email'];

if(isset($_GET['delete'])){

	$delete=$_GET['delete'];
	$sql="delete from cart where id='$delete' AND email='$email'";
	$result=$conn->query($sql);
}

$keyword="";
if(isset($_POST['search_product'])){
	$keyword=$_POST['search_product'];
	$keyword=" where product.title like '%$keyword%' or product.description like '%$keyword%'";
}

$sql="select * from cart WHERE email='$email'";
$result=$conn->query($sql);
    $sqli = "SELECT COUNT(*) AS countquantity FROM cart WHERE email='$email'";
    $duration = $conn->query($sqli);
    $record = $duration->fetch_array();
    $totalquantity = $record['countquantity'];
?>


<?php
    $sql_qry = "SELECT SUM(totalPrice) AS count FROM cart WHERE totalPrice AND email='$email'";

    $duration = $conn->query($sql_qry);
    $record = $duration->fetch_array();
    $total = $record['count'];
	?>

<!DOCTYPE html>
<html lang="en">    
    <link rel="stylesheet" href="style.css">
    
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

:root {
  --white: #fff;
  --black: #222;
  --pink: #f60091;
  --grey: #444;
  --grey2: #959595;
  --grey-alt: #d1e2e9;
  --yellow: #ffd800;
  --green: #59b210;
}

*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}

html {
  width: 100%;
  height:100%;
  scroll-behavior: smooth;
  box-sizing: border-box;
  font-size:62.5%;
}

body {
  font-family: "Poppins", sans-serif;
  font-size: 1.6rem;
  font-weight: 400;
  color: #243a6f;
  position: relative;
  z-index: 1;
}

h1,
h2,
h3,
h4 {
  font-weight: 500;
}

a {
  color: inherit;
  text-decoration: none;
}

img {
  max-width: 100%;
}

li {
  list-style: none;
}

.container {
  max-width: 120rem;
  margin: 0 auto;
}

.container-md {
  max-width: 100rem;
  margin: 0 auto;
}

@media only screen and (max-width: 1200px) {
  .container {
    padding: 0 3rem;
  }

  .container-md {
    padding: 0 3rem;
  }
}





/* Adverts */
.section {
  padding: 10rem 0 5rem 0;
}

.advert-center {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
  gap: 3rem;
}

.advert-box {
  position: relative;
  color: #fff;
  height: 27rem;
  border-radius: 1rem;
  padding: 1.6rem;
  overflow: hidden;
  z-index: 1;
}

.advert-box img {
  position: absolute;
  bottom: 0%;
  left: -20%;
  height: 100%;
  width: 35rem;
  z-index: -1;
}

.advert-box:nth-child(1) {
  background-color: #f5c5d1;
}

.advert-box:nth-child(2) {
  background-color: #a1d1df;
}

.advert-box:nth-child(3) {
  background-color: #e5bc00;
}

.advert-box .dotted {
  position: relative;
  height: 100%;
  border: 2px dashed #f1f1f1;
  border-radius: 1rem;
}

.advert-box .content {
  position: absolute;
  top: 50%;
  right: 5%;
  transform: translate(0, -50%);
}

.advert-box .content h2,
.advert-box .content h4 {
  text-shadow: 5px 6px 0px rgba(37, 59, 112, 0.1);
}

.advert-box .content h2 {
  line-height: 1.2;
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

.advert-box .content h4 {
  font-size: 1.5rem;
  text-transform: capitalize;
}

/* Featured Products */

.title {
  margin: 4rem 0 7rem 0;
  text-align: center;
}

.title h1 {
  font-size: 3rem;
  display: inline-block;
  position: relative;
  z-index: 0;
}

.title h1::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: -20%;
  transform: translate(-50%, -50%);
  background-color: var(--pink);
  width: 50%;
  height: 0.4rem;
  z-index: 1;
}

/* Product */
.product-center {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
  gap: 7rem 3rem;
}

.product {
  height: 48rem;
  background-color: #fff;
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
  border-radius: 1rem;
  text-align: center;
  transition: all 300ms ease-in-out;
}

.product:hover {
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.25);
}

.product-header {
  position: relative;
  height: 35rem;
  background-color: #f6f2f1;
  transition: all 300ms ease-in-out;
  z-index: 0;
}

.product-header img {
  height: 100%;
}

.product-footer {
  padding: 2rem 1.6rem 1.6rem 1.6rem;
}

.product-footer h3 {
  font-size: 2.2rem;
}

.rating {
  color: #43b3d9;
}

.product-footer .price {
  color: #ff7c9c;
  font-size: 2rem;
}

.product:hover .product-header::after {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  border-radius: 1rem 1rem 0 0;
  background-color: rgba(0, 0, 0, 0.5);
  transition: all 500ms ease-in-out;
  z-index: 1;
}

.product-header .icons {
  position: absolute;
  right: 5%;
  top: 50%;
  transform: translate(0, -50%) scale(0);
  z-index: 2;
  opacity: 0;
  transition: all 500ms ease-in-out;
}

.product-header .icons span {
  background-color: #fff;
  font-size: 2.5rem;
  display: block;
  border-radius: 50%;
  padding: 1.5rem 1.6rem;
  line-height: 2rem;
  cursor: pointer;
  transition: all 300ms ease-in-out;
}

.product-header .icons span i {
  transition: all 500ms ease-in-out;
}

.product-header .icons span:not(:last-child) {
  margin-bottom: 1rem;
}

.product-header .icons span:hover {
  background-color: #ff7c9c;
  color: #fff;
}

.product:hover .icons {
  opacity: 1;
  transform: translate(0, -50%) scale(1);
}

.product-header .icons a {
  display: block;
  margin-bottom: 1rem;
}

/* Exclusive Product */
.product-banner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  height: 50rem;
  background-color: #243a6f;
}

.product-banner .left img {
  object-fit: cover;
  height: 100%;
}

.product-banner .right {
  align-self: center;
  text-align: center;
  padding: 1.6rem;
}

.product-banner .content h2 {
  color: #fbb419;
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

.product-banner .content .discount {
  color: #b888ff;
}

.product-banner .content h1 span {
  color: #fff;
  font-size: 6rem;
  font-weight: 700;
  display: block;
  line-height: 1;
}

@media only screen and (max-width: 996px) {
  .product-banner .content h1 span {
    font-size: 5rem;
  }
}

@media only screen and (max-width: 768px) {
  .product-banner {
    grid-template-columns: 1fr;
  }

  .product-banner .left {
    display: none;
  }

  .product-banner .content h1 span {
    font-size: 4rem;
  }

  .product-banner .content h2 {
    font-size: 2rem;
  }

  .product-banner .content a {
    padding: 1rem 3rem;
  }
}

/* Testimonials */
.testimonial-center {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
  gap: 6rem;
}

.testimonial {
  position: relative;
  padding: 5rem;
  background-color: #fff;
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
  transition: all 300ms ease-in-out;
  text-align: center;
  border-radius: 0.5rem;
}

.testimonial:hover {
  box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.2);
  transform: translateY(-1rem);
}

.testimonial span {
  position: absolute;
  top: 2%;
  left: 50%;
  font-size: 12rem;
  font-family: sans-serif;
  color: #ff7c9c;
  line-height: 1;
  transform: translate(-50%, 0);
}

.testimonial p {
  margin: 2rem 0 1rem 0;
}

.testimonial .rating {
  margin-bottom: 1rem;
}

.testimonial .img-cover {
  border-radius: 50%;
  width: 8rem;
  height: 8rem;
  overflow: hidden;
  margin: 0 auto;
}

.testimonial .img-cover img {
  height: 100%;
  object-fit: cover;
}

.testimonial h4 {
  margin-top: 1rem;
}

/* Brands */
.brands-center {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 3rem;
}

.brand {
  height: 8rem;
  width: 8rem;
  margin: 0 auto;
}

.brand img {
  object-fit: contain;
}

@media only screen and (max-width: 768px) {
  .brands-center {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* ========= Footer ======== */
.footer {
  background-color: var(--black);
  padding: 6rem 1rem;
  line-height: 3rem;
}

.footer-center span {
  margin-right: 1rem;
}

.footer-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  color: var(--white);
}

.footer-center a:link,
.footer-center a:visited {
  display: block;
  color: #f1f1f1;
  font-size: 1.4rem;
  transition: 0.6s;
}

.footer-center a:hover {
  color: var(--pink);
}

.footer-center div {
  color: #f1f1f1;
  font-size: 1.4rem;
}

.footer-center h3 {
  font-size: 1.8rem;
  font-weight: 400;
  margin-bottom: 1rem;
}

@media only screen and (max-width: 998px) {
  .footer-container {
    grid-template-columns: repeat(2, 1fr);
    row-gap: 2rem;
  }
}

@media only screen and (max-width: 768px) {
  .footer-container {
    grid-template-columns: 1fr;
    row-gap: 2rem;
  }
}

/* All Products */
.section .top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 4rem;
}

.all-products .top select {
  font-family: "Poppins", sans-serif;
  width: 20rem;
  padding: 1rem;
  border: 1px solid #ccc;
  appearance: none;
  outline: none;
}

form {
  position: relative;
  z-index: 1;
}

form span {
  position: absolute;
  top: 50%;
  right: 1rem;
  transform: translateY(-50%);
  font-size: 2rem;
  z-index: 0;
}

@media only screen and (max-width: 768px) {
  .all-products .top select {
    width: 15rem;
  }
}

/* Pagination */
.pagination {
  padding: 3rem 0 5rem 0;
}

.pagination span {
  display: inline-block;
  padding: 1rem 1.5rem;
  border: 1px solid #243a6f;
  font-size: 1.8rem;
  margin-bottom: 2rem;
  cursor: pointer;
  transition: all 300ms ease-in-out;
}

.pagination span:hover {
  border: 1px solid #243a6f;
  background-color: #243a6f;
  color: #fff;
}

/* Detail */
.product-detail .details {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 7rem;
}

.product-detail .left {
  display: flex;
  flex-direction: column;
}

.product-detail .left .main {
  text-align: center;
  background-color: #f6f2f1;
  margin-bottom: 2rem;
  height: 45rem;
  padding: 3rem;
}

.product-detail .left .main img {
  object-fit: contain;
  height: 100%;
}

.product-detail .thumbnails {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1rem;
}

.product-detail .thumbnail {
  width: 10rem;
  height: 10rem;
  background-color: #f6f2f1;
  text-align: center;
}

.product-detail .thumbnail img {
  height: 100%;
  object-fit: contain;
}

.product-detail .right span {
  display: inline-block;
  font-size: 1.5rem;
  margin-bottom: 1rem;
}

.product-detail .right h1 {
  font-size: 4rem;
  line-height: 1.2;
  margin-bottom: 2rem;
}

.product-detail .right .price {
  font-size: 600;
  font-size: 2rem;
  color: #ff7c9c;
  margin-bottom: 2rem;
}

.product-detail .right div {
  display: inline-block;
  position: relative;
  z-index: 1;
}

.product-detail .right select {
  font-family: "Poppins", sans-serif;
  width: 20rem;
  padding: 0.7rem;
  border: 1px solid #ccc;
  appearance: none;
  outline: none;
}

.product-detail form {
  margin-bottom: 2rem;
}

.product-detail form span {
  position: absolute;
  top: 50%;
  right: 1rem;
  transform: translateY(-50%);
  font-size: 2rem;
  z-index: 0;
}

.product-detail .form {
  margin-bottom: 3rem;
}

.product-detail .form input[type="number"] {
  padding: 0.8rem;
  text-align: center;
  width: 7.5rem;
  margin-right: 2rem;
}

.product-detail .form input[type="submit"] {
  text-align: center;
  width: 20.5rem;
  margin-right: 2rem;
}

.product-detail .form .addCart{
  background: #ff7c9c;
  padding: 0.8rem 4rem;
  color: #fff;
  border-radius: 3rem;
  text-decoration:none;
}

.product-detail .form .addCart:hover {

        background-color: red;

}

.product-detail h3 {
  text-transform: uppercase;
  margin-bottom: 2rem;
}

@media only screen and (max-width: 996px) {
  .product-detail .left {
    width: 30rem;
    height: 45rem;
  }

  .product-detail .details {
    gap: 3rem;
  }

  .product-detail .thumbnails {
    width: 30rem;
    gap: 0.5rem;
  }

  .product-detail .thumbnail {
    width: auto;
    height: 10rem;
    background-color: #f6f2f1;
    text-align: center;
    padding: 0.5rem;
  }
}

@media only screen and (max-width: 650px) {
  .product-detail .details {
    grid-template-columns: 1fr;
  }

  .product-detail .right {
    margin-top: 10rem;
  }

  .product-detail .left {
    width: 100%;
    height: 45rem;
  }

  .product-detail .details {
    gap: 3rem;
  }

  .product-detail .thumbnails {
    width: 100%;
    gap: 0.5rem;
  }
}

/* Cart Items */
/* .cart {
  margin: 10rem auto;
} */

table {
  width: 100%;
  border-collapse: collapse;
}

.cart-info {
  display: flex;
  flex-wrap: wrap;
}

th {
  text-align: left;
  padding: 0.5rem;
  color: #fff;
  background-color: #f5a623;
  font-weight: normal;
}

td {
  padding: 1rem 0.5rem;
}

td input {
  width: 5rem;
  height: 3rem;
  padding: 0.5rem;
}

td a {
  color: orangered;
  font-size: 1.4rem;
}

td img {
  width: 8rem;
  height: 8rem;
  margin-right: 1rem;
}

.total-price {
  display: flex;
  justify-content: flex-end;
  align-items: end;
  flex-direction: column;
  margin-top: 2rem;
}

.total-price table {
  border-top: 3px solid #f5a623;
  width: 100%;
  max-width: 35rem;
}

td:last-child {
  text-align: right;
}

th:last-child {
  text-align: right;
}

@media only screen and (max-width: 567px) {
  .cart-info p {
    display: none;
  }
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
    color: #fff;
}

.good a:hover {
    color: #f5a623;
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
    </style>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  <!-- Box icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

  <!-- Glidejs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css" />
  <!-- Custom StyleSheet -->

  <link rel="stylesheet" href="../css/menu.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

<title>STUBEX - My Cart</title>
<link rel="icon" href="../images/logo/icon1.png" sizes="32x32" type="image/png" sizes="50x50">
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

<div style="background:white; padding-top:50px;">
        <!-- Cart Items -->
  <div class="container-md cart">
    <table>
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>
      <?php
						if ($result->num_rows > 0) {    
							while($row = $result->fetch_assoc()) {
								$id=$row['id'];
								$title=$row['title'];
								$description=$row['description'];
								$quantity=$row['quantity'];
								$totalPrice=$row['totalPrice'];
                $price=$row['price'];
                $ikey=$row['ikey'];
								$image=$row['image'];
								$category=$row['category'];

                $sql2="SELECT quantity AS quantity2 from product where id='$id'";
                $result2=$conn->query($sql2);
                if ($result2->num_rows > 0) {    
                  while($row = $result2->fetch_assoc()) {
                    //display result
                    $quantity2=$row['quantity2'];           
					?>
          
      <tr>
        <td>
          <div class="cart-info">
            <img src="../images/<?php echo $image; ?>" alt="">
            <div>
              <p><?php echo $title; ?></p>
              <span>RM <?php echo $price; ?></span>
              <br />
              <a href="cart.php?delete=<?php echo $id;?>">remove</a>
            </div>
          </div>
        </td>
        <td>
          <form action ="cart.php" method ="POST">
          <input type ="hidden" name="ikey" value ="<?php echo $ikey;?>"/>
          <input type ="hidden" name="price" value ="<?php echo $price;?>"/>    
          <input type="number" name="quantity" value="<?php if ($quantity2>=$quantity){echo $quantity;} else{ echo '1' ;} ?>" min="1" max="<?php echo $quantity2;?>">
          <input style="background-color: #f5a623;
  width:70px;
  border: none;
  color: white;
  padding: 10px 10px;
  text-align: center;
  text-decoration: none;
  font-size: 10px;
  cursor: pointer;" type="submit"  name="updatecart" id="updatecart" value="UPDATE"/>
        </form>
        </td>
        <td>RM <?php echo $totalPrice; ?></td>
      </tr>
      <?php
                  }
                }
							} //end while loop
						}	// end if statement
					?>
    </table>

    <div class="total-price">
      <table>
        <tr>
          <td>Subtotal</td>
          <td>RM <?php
        if($total>0){
          echo $total;
        }
          else {
            echo "0";
          }
      ?></td>
        </tr>
        
      </td>
      <td>Shipping Fee</td>
      <?php
        $sql5 = "SELECT COUNT(*) AS durant FROM (SELECT COUNT(seller_id) FROM cart WHERE email='$email' GROUP BY seller_id HAVING COUNT(seller_id) >= 1) AS durant;";
        $duration5 = $conn->query($sql5);
        $record5 = $duration5->fetch_array();
        $totalquantity5 = $record5['durant'];
?>
          <td>RM <?php
        if($total>0){
          ($totalshipping = $totalquantity5 * 5);
          echo number_format((float)$totalshipping, 2, '.', '');
        }
          else {
            echo "0";
          }
      ?></td>
      
        </tr>
        <td style="font-weight:bold;">Total Payment</td>
          <td style="font-weight:bold;">RM <?php
        if($total>0){
          $totalpayment = $totalshipping + $total;
          echo number_format((float)$totalpayment, 2, '.', '');
        }
          else {
            echo "0";
          }
      ?></td>
      </table>

      <?php 
        if($total>0){
          echo '<a href="checkout.php" class="checkout btn" style="display: inline-block;
          background-color: #f5a623;
          padding: 1.2rem 4rem;
          color: #fff;
          font-weight: 600;
          text-transform: uppercase;
          margin-top: 3rem;">Proceed To Checkout</a>';
        }
          else {
            echo "No Item In the Cart!";
          }
      ?>

    </div>

  </div>

</body>

<?php

if(isset($_POST['updatecart'])){
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

</html>