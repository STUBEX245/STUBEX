<?php
	session_start();
	include_once('../config.php');

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$home_address = $_POST['home_address'];
		$zip = $_POST['zip'];
		$state = $_POST['state'];
		$area = $_POST['area'];
		$phone_number = $_POST['phone_number'];
		$sql = "UPDATE address SET home_address = '$home_address', zip = '$zip', state = '$state', area = '$area', phone_number = '$phone_number' WHERE id = '$id'";

		//use for MySQLi OOP
		if($conn->query($sql)){
			$_SESSION['success'] = 'Address updated successfully';
		}
		
		else{
			$_SESSION['error'] = 'Something went wrong in updating address';
		}
	}
	else{
		$_SESSION['error'] = 'Select address to edit first';
	}

	header('location: address.php');

?>