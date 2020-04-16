<?php

include("connect.php");

if(isset($_GET['id']) && !empty($_GET['id'])){
  $output = array();
	$order_number = $_GET['id'];

  $query = "SELECT state FROM orders WHERE id = '".$order_number."' ";

  $result = mysqli_query($conn, $query);

  $row = mysqli_fetch_assoc($result);

  $state = $row["state"];

  if ($state == 1) {

    $query = "SELECT o.state, i.* FROM orders o INNER JOIN items i ON o.id = i.order_id WHERE o.id = '".$order_number."' ";
    $result = mysqli_query($conn, $query);
    $data = array();
    while($rows = mysqli_fetch_assoc($result)){
        $data[] = $rows;
    }
    $sql = array(); 
    foreach( $data as $row ) {
        $sql[] = '('.$row['id'].', '.$row['store_id'].', 1)';
    }
    $result = mysqli_query($conn, 'INSERT INTO store_orders (`item_id`, `store_id`, `status`) VALUES '.implode(',', $sql));

    $query = "UPDATE orders SET state='2' WHERE id='".$order_number."' ";
  }elseif ($state == 2) {
      $query = "UPDATE orders SET state='3' WHERE id='".$order_number."' ";
  }elseif ($state == 3) {
    $query = "UPDATE orders SET state='4' WHERE id='".$order_number."' ";
    }

  $result = mysqli_query($conn, $query);

  if($result){
      header('Location:orders.php?updated=1');
  }else{
      header('Location:orders.php?unupdated=1');
  }
}
?>
