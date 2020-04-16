<?php
  	include("connect.php");
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id=$_GET['id'];
    $sql="DELETE FROM products WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('Location:products.php?success=1');
    }else{
        header('Location:products.php?error=1');
    }
}else{
    header('Location:products.php');
}
?>
