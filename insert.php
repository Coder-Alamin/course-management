<?php
  session_start();
   if(!empty($_SESSION['login'])){
   }else{
    header('location:login.php');
   }
   include 'connect.php';
   if(isset($_POST['submit']))
    {
        $semester_no    =   $_POST['semester_no'];
        $course_code    =   $_POST['course_code'];
        $course_title   =   $_POST['course_title'];
        $contact_hours  =   $_POST['contact_hours'];
        $credits        =   $_POST['credits'];
        $course_teacher =   $_POST['course_teacher'];

        $sql="INSERT INTO course(Semester_No,Course_Code,Course_Title,Contact_Hours,Credits,Course_Teacher)
        VALUES('$semester_no','$course_code',' $course_title','$contact_hours',' $credits','$course_teacher')";
        $result=mysqli_query($conn,$sql);
        if($result){
            header('location: view.php');
        }
        else{
            die(mysqli_error($conn));
        }

    }
?>