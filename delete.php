<?php
  session_start();
   if(!empty($_SESSION['login'])){
   }else{
    header('location:login.php');
   }

    include 'connect.php';
    if(isset($_GET['delete_id']))
    {
        $delete_id=$_GET['delete_id'];
        $sql="DELETE FROM course WHERE id='$delete_id' ";
        $result=mysqli_query($conn,$sql);
        if($result){
           header('location: view.php');
        }
        else{
             die(mysqli_error($conn));
        }
    }
?>

