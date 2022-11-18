<?php
        $conn=mysqli_connect('localhost','root','','course_management');
        if(!$conn){
             die(mysqli_error($conn));
         }
?>