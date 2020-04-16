<?php

include("connect.php");
if(isset($_POST["order_number"]))
{
	$order_number = $_POST["order_number"];
	$output = array();

	$query = "SELECT * FROM items i INNER JOIN stores s ON i.store_id = s.id INNER JOIN products p ON i.product_id = p.id INNER JOIN store_orders so ON so.item_id = i.id WHERE i.order_id = '".$order_number."' ";

	$result = mysqli_query($conn, $query);

	//$filtered_rows = $statement->rowCount();

  $products = array();
  $price = 0;

	while($row = mysqli_fetch_assoc($result)){
		if ($row['status'] == 1) {
			$row['status'] = '<span class="badge badge-success text-sm col-sm-6" style="margin: 8px;"> Proccessing </span>';
		}elseif ($row['status'] == 2) {
			$row['status'] = '<span class="badge badge-success text-sm col-sm-6" style="margin: 8px;"> Ready to ship </span>';
		}elseif ($row['status'] == 3) {
			$row['status'] = '<span class="badge badge-success text-sm col-sm-6" style="margin: 8px;"> Delivered </span>';
		}
    $products[] = $row;
		//$price = $price + $row["total_price"];

	}

  echo json_encode($products);
}
?>
