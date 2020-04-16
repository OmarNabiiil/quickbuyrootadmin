<?php

include("connect.php");
if(isset($_POST["store_id"]))
{
	$store_id = $_POST["store_id"];
	$output = array();

	$query = "SELECT * FROM products WHERE store_id = '".$store_id."' ";

	$result = mysqli_query($conn, $query);

	//$filtered_rows = $statement->rowCount();

  $products = array();
  $price = 0;

	while($row = mysqli_fetch_assoc($result)){
		if ($row['available_quantity'] > $row['minimum_quantity']) {
			$row['status'] = '<span class="badge badge-success text-sm col-sm-6" style="margin: 8px;"> Updated </span>';
		}else{
			$row['status'] = '<span class="badge badge-danger text-sm col-sm-6" style="margin: 8px;"> Not updated </span>';
		}
    $products[] = $row;
		//$price = $price + $row["total_price"];

	}

  echo json_encode($products);
}
?>
