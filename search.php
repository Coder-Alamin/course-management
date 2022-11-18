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
    <title>Search Courses</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
           <div class="pt-1 mt-3 border border-success">
                    <h4 class="text-center p-2 bg-success text-white">Search Courses</h4>
                    
                    <?php
                           include 'connect.php';
                            if(isset($_POST['submit']))
                            {
                                $search=$_POST['search'];
                                $sql="SELECT * FROM course WHERE  Semester_No like '%$search%' or Course_Code like '%$search%' 
                                    or Course_Title like '%$search%' or Credits like '%$search%' or Course_Teacher like '%$search%' ";
                                $result=mysqli_query($conn,$sql);
                                if($result)
                                { 
                                    if(mysqli_num_rows($result)>0)
                                    {
                                        echo "<table class='table table-success'> 
                                        <tr>
                                           
                                            <th class='text-center'>Semester_No</th>
                                            <th class='text-center'>Course_Code</th>
                                            <th class='text-center'>Course_Title</th>
                                            <th class='text-center'>Contact_Hours</th>
                                            <th class='text-center'>Credits</th>
                                            <th class='text-center'>Course_Teacher</th>
                                            <th class='text-center'>Actions</th>
                                        </tr>";

                                        while($data = mysqli_fetch_assoc($result))
                                        { 
                                            $id             = $data['id'];
                                            $semester_no    = $data['Semester_No'];
                                            $course_code    = $data['Course_Code'];
                                            $course_title   = $data['Course_Title'];
                                            $contact_hours  = $data['Contact_Hours'];
                                            $credits        = $data['Credits'];
                                            $course_teacher = $data['Course_Teacher'];

                                            echo "<tr>
                                                        
                                                        <td class='text-center'>$semester_no</td>
                                                        <td class='text-center'>$course_code</td>
                                                        <td class='text-center'>$course_title </td>
                                                        <td class='text-center'>$contact_hours</td>
                                                        <td class='text-center'>$credits</td>
                                                        <td class='text-center'>$course_teacher</td>
                                                        <td class='text-center'>
                                                            <span class='btn btn-success p-1'> 
                                                                <a href='update.php? update_id=$id' class='text-white text-decoration-none'>
                                                                    Update
                                                                </a>
                                                            </span> 
                                                            <span class='btn btn-danger p-1'>
                                                                <a href='delete.php? delete_id=$id' class='text-white text-decoration-none'>
                                                                    Delete
                                                                </a>
                                                            </span>
                                                        </td>
                                                </tr>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5 class='text-danger text-center' >Data is not found!</h5>";
                                    }
                                }
                            }
                    ?>
                    
                        </div>
        </div>
         
    </div>
  </body>
</html>

