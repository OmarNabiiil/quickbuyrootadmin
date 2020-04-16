<?php
include("connect.php");

$sql="SELECT * FROM stores";
$result=mysqli_query($conn,$sql);
if($result){
    $sessions = array();
    while($rows=mysqli_fetch_assoc($result)){
        $sessions[] = $rows;
    }

    $output = array(
        "draw"				=>	intval($_POST["draw"]),
        "recordsTotal"		=> 	mysqli_num_rows($result),
        "recordsFiltered"	=>	mysqli_num_rows($result),
        "data"				=>	$sessions
    );
header("Access-Control-Allow-Origin: *");

    echo json_encode($output);
}else{
    $data = [ 'Error' => 'Failed to retrieve the groups'];
    echo  json_encode($data);
}
