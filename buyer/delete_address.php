<?php
	session_start();
	include_once('../config.php');

	if(isset($_GET['id'])){
		$sql = "DELETE FROM address WHERE id = '".$_GET['id']."'";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Address deleted successfully';
		}
		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting';
		}
	}
	else{
		$_SESSION['error'] = 'Select address to delete first';
	}

	header('location: address.php');
?>