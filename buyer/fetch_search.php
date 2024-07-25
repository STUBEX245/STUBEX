<?php

$connect = mysqli_connect("localhost", "root", "", "fyp_project");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM product 
  WHERE title LIKE '%".$search."%'
 ";
}

$output = '

';

$result=$conn->query($sql);

if ($result->num_rows > 0) {    
    while($row = $result->fetch_assoc()) {

		$output .= '

              <div class="card">
                <div class="card-body text-center">
                  <img src="../images/'.$row["image"].'" class="product-image">
                  <h5 class="card-title" style="display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;height:65px;"><b>'.$row["title"].'</b></h5>
                  <p class="card-text small" style="display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;height:37px;">'.$row["description"].'</p>
                  <p class="tags">RM '.$row["price"].'</p>
                  
                  <a href="product_detail.php?pid='.$row["id"].'" class="btn btn-success button-text"> Check Details</a>
                            </div>
                

		';
	}
}
else
{
	$output .= '
		<h3 align="center">No Product Found</h3>
	';
}
$output .= '
</div>
';

echo $output;

?>