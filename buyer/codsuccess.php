<?php
include_once('../config.php');
session_start();
            
            $email = $_SESSION['email'];
            $delivery_address = $_POST["cars"];
            $query = "SELECT * FROM cart WHERE email='$email'";
            $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)){
            $email = $_SESSION['email'];
		    $id=$row['id'];
			$title=$row['title'];
			$category=$row['category'];
			$quantity=$row['quantity'];
			$price=$row['price'];
			$image=$row['image'];
			$description=$row['description'];
            $totalPrice=$row['totalPrice'];
            $seller_id=$row['seller_id'];

            if (!function_exists('createRandomString')){
            function createRandomString() {
                $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
                srand((double)microtime()*1000000);
                $i = 0;
                $randomstring = '' ;
            
                while ($i <= 12) {
                    $num = rand() % 33;
                    $tmp = substr($chars, $num, 1);
                    $randomstring = $randomstring . $tmp;
                    $i++;
                }
            
                return $randomstring;
            }
        }
            $unique = createRandomString();
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $date = date('m/d/Y h:i:s a', time());

            $decrease_quantity="UPDATE product set quantity=quantity-'$quantity' where id='$id'";
            $quantity_result = mysqli_query($conn, $decrease_quantity);

            $query1 = "INSERT INTO order_list (transaction_id ,id, title, description, quantity, price, image, category, totalPrice, custemail, payment_method, payment_status, order_status,delivery_address,seller_id) VALUES ('$unique' , '$id', '$title', '$description', '$quantity', '$price', '$image', '$category', '$totalPrice', '$email','COD', 'Un-Paid', 'Pending','$delivery_address','$seller_id')";
            $result1 = mysqli_query($conn, $query1);


            $query2 = "DELETE FROM cart WHERE email='$email'";
            $result2 = mysqli_query($conn, $query2);

    }

    ?>

<div class="container">
   <div class="row">
      <div class="col-md-6 mx-auto mt-5">
         <div class="payment">
            <div class="payment_header">
               <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
            </div>
            <div class="content">
               <h1>Payment Successful</h1>
               <p> <br> Thank you for shopping in our store. <br> <br> <br> <a href="buyerMain.php">Go to Home</a></p>
            </div>
         </div>
      </div>
   </div>
</div>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

<style type="text/css">

    body
    {
        background:#f2f2f2;
    }

    .payment
	{
		border:1px solid #f2f2f2;
		height:380px;
        border-radius:20px;
        background:#fff;
	}
   .payment_header
   {
	   background:rgba(255,102,0,1);
	   padding:50px;
       border-radius:50px 50px 0px 0px;
	   
   }
   
   .check
   {
	   margin:0px auto;
	   width:50px;
	   height:50px;
	   border-radius:100%;
	   background:#fff;
	   text-align:center;
   }
   
   .check i
   {
	   vertical-align:middle;
	   line-height:50px;
	   font-size:30px;
   }

    .content 
    {
        text-align:center;
    }

    .content  h1
    {
        font-size:25px;
        padding-top:25px;
    }

    .content a
    {
        width:200px;
        height:35px;
        color:#fff;
        border-radius:30px;
        padding:5px 10px;
        background:rgba(255,102,0,1);
        transition:all ease-in-out 0.3s;
    }

    .content a:hover
    {
        text-decoration:none;
        background:#000;
    }
   
</style>