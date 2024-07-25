<?php include('../config.php');
session_start();

$output= array();
$sql = "SELECT * FROM address WHERE email='$_SESSION['email']'";

$totalQuery = mysqli_query($conn,$sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
	0 => 'id',
	1 => 'home_address',
	2 => 'zip',
	3 => 'state',
	4 => 'area',
	5 => 'phone_number',
);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE home_address like '%".$search_value."%'";
	$sql .= " OR zip like '%".$search_value."%'";
	$sql .= " OR state like '%".$search_value."%'";
	$sql .= " OR area like '%".$search_value."%'";
	$sql .= " OR phone_number like '%".$search_value."%'";
}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY id desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	

$query = mysqli_query($conn,$sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while($row = mysqli_fetch_assoc($query))
{
	$sub_array = array();
	$sub_array[] = $row['id'];;
	$sub_array[] = $row['home_address'];
	$sub_array[] = $row['zip'];
	$sub_array[] = $row['state'];
	$sub_array[] = $row['area'];
	$sub_array[] = $row['phone_number'];
	$sub_array[] = '<a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="'.$row['id'].'"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows ,
	'recordsFiltered'=>   $total_all_rows,
	'data'=>$data,
);
echo  json_encode($output);
