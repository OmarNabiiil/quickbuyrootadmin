<?php
    include("connect.php");
    $name_en = $_POST['name_en'];
    $name_ar = $_POST['name_ar'];
    $description_en = $_POST['description_en'];
    $description_ar = $_POST['description_ar'];
    $category_en = $_POST['category_en'];
    $category_ar = $_POST['category_ar'];
    $quantity = $_POST['quantity'];
    $min_quantity = $_POST['minimum_quantity'];
    $price = $_POST['price'];

    $query = "SELECT code FROM products ORDER BY code DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row>0) {
      $code = $row["code"]+1;
    }else{
      $code = 1000;
    }

    if(isset($_FILES["my-image-selector"]))
  	{
  		$extension = explode('.', $_FILES['my-image-selector']['name']);
  		$new_name = rand() . '.' . $extension[1];
  		$destination = './images/' . $new_name;
  		move_uploaded_file($_FILES['my-image-selector']['tmp_name'], $destination);
  		$image = $new_name;
  	}

    if(isset($_FILES["my-poster-selector"]))
    {
        $extension = explode('.', $_FILES['my-poster-selector']['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = './images/' . $new_name;
        move_uploaded_file($_FILES['my-poster-selector']['tmp_name'], $destination);
        $poster = $new_name;
    }
    
    $query = "INSERT INTO `products`(`name_en`, `name_ar`, `description_en`, `description_ar`, `category_en`, `category_ar`, `price`, `available_quantity`, `minimum_quantity`, `imageUrl`, `posterUrl`, `code`) VALUES ('$name', '$description', '$category', '$price', '$quantity', '$min_quantity', '$image', '$poster', '$code')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'success';
        // code...
      }else{
        echo 'fail';
      }