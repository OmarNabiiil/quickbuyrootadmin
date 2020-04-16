<?php
  	include("connect.php");
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id=$_GET['id'];
    $sql="UPDATE users SET status = 1 WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('Location:users.php?blocked=1');
    }else{
        header('Location:users.php?error=1');
    }
}else{
    header('Location:users.php');
}
?>
