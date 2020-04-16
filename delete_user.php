<?php
  	include("connect.php");
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id=$_GET['id'];
    $sql="DELETE FROM users WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('Location:users.php?success=1');
    }else{
        header('Location:users.php?error=1');
    }
}else{
    header('Location:inventory.php');
}
?>
