<?php 
include('../config.php');
session_start();

$home_address = $_POST['home_address'];
$zip = $_POST['zip'];
$state = $_POST['state'];
$area = $_POST['area'];
$phone_number = $_POST['phone_number'];
$id = $_POST['id'];

$sql = "UPDATE `address` SET  `home_address`='$home_address' , `zip`= '$zip', `state`='$state',  `area`='$area',  `phone_number`='$phone_number' WHERE id='$id' ";
$query= mysqli_query($conn,$sql);
$lastId = mysqli_insert_id($conn);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>