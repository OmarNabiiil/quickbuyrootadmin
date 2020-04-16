<?php
    include("connect.php");
    $name = $_POST['name'];
    $description = $_POST['description'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $building = $_POST['building_no'];
    $floor_no = $_POST['floor_no'];
    $mobile = $_POST['mobile'];

    $query = "INSERT INTO stores(store_name, country, city, street, building, floor_no, mobile, description) VALUES ('$name', '$country', '$city', '$street', '$building', '$floor_no', '$mobile', '$description')";
    $result = mysqli_query($conn, $query);

    if ($result) {

      echo 'success';
      // code...
    }else{

            echo 'fail';
    }
 ?>
