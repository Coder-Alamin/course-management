  <?php
      session_start();
        if(!empty($_SESSION['login'])){
        }else{
          header('location:login.php');
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updating Courses</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<?php
    include 'connect.php';
    if($_GET['update_id'])
    {
        $get_update_id=$_GET['update_id'];
        $sql="SELECT * FROM course WHERE id='$get_update_id' ";
        $query=mysqli_query($conn,$sql);
        $data=mysqli_fetch_assoc($query);

        $id             =$data['id'];
        $semester_no    =$data['Semester_No'];
        $course_code    =$data['Course_Code'];
        $course_title   =$data['Course_Title'];
        $contact_hours  =$data['Contact_Hours'];
        $credits        =$data['Credits'];
        $course_teacher =$data['Course_Teacher'];
    }
   if(isset($_POST['update']))
   {
        $id             =   $_POST['id'];
        $semester_no    =   $_POST['semester_no'];
        $course_code    =   $_POST['course_code'];
        $course_title   =   $_POST['course_title'];
        $contact_hours  =   $_POST['contact_hours'];
        $credits        =   $_POST['credits'];
        $course_teacher =   $_POST['course_teacher'];

        $sql="UPDATE course SET 
                Semester_No= '$semester_no',
                Course_Code= '$course_code',
                Course_Title= '$course_title',
                Contact_Hours='$contact_hours',
                Credits='$credits',
                Course_Teacher='$course_teacher' WHERE id='$id' ";
        
        $result=mysqli_query($conn,$sql);
        if($result){
            header('location:view.php');
        }
        else{
           die(mysqli_error($conn));
        }
   }
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            </div>

            <div class="col-sm-6 pt-1 mt-2 border border-success">
                <h4 class="text-center bg-success text-white p-2">Update Course</h4> <br>
                <form action="update.php" method="POST">
                    <div class="mb-2">
                        <label  class="form-label">Semester_No</label>
                        <input type="text" class="form-control" name="semester_no" value="<?php echo  $semester_no ?>" autocomplete="off" required >
                    </div>
                     <div class="mb-2">
                        <label  class="form-label">Course_Code</label>
                        <input type="text" class="form-control" name="course_code" value="<?php echo  $course_code ?>" autocomplete="off" required >
                    </div>
                     <div class="mb-2">
                        <label  class="form-label">Course_Title</label>
                        <input type="text" class="form-control" name="course_title" value="<?php echo  $course_title ?>" autocomplete="off" required >
                    </div>
                     <div class="mb-2">
                        <label  class="form-label">Contact_Hours</label>
                        <input type="text" class="form-control" name="contact_hours" value="<?php echo  $contact_hours?>" autocomplete="off" required >
                    </div>
                     <div class="mb-2">
                        <label  class="form-label">Credits</label>
                        <input type="text" class="form-control" name="credits" value="<?php echo  $credits ?>" autocomplete="off" required >
                    </div>
                     <div class="mb-2">
                        <label  class="form-label">Course_Teacher</label>
                        <input type="text" class="form-control" name="course_teacher" value="<?php echo  $course_teacher ?>" autocomplete="off" required >
                    </div>
                   
                    <input type="text" name="id" value="<?php echo $id ?>" hidden>

                     <div class="mb-2 mt-1 text-center">
                         <input type="submit"  value="Update" name="update" class="btn btn-success">
                    </div>
                    
                </form>
                
            </div>

            <div class="col-sm-3">
            </div>

        </div>
    </div>
   
    
</body>
</html>