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
    <title>Course Form</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            </div>

            <div class="col-sm-6 pt-1 mt-2 border border-success">
                <div class="mb-2">
                       <h4 class="text-center bg-success text-white p-1">Add Courses</h4>
                </div>

                
                <form action="insert.php" method="POST">
                     <div class="mb-2">
                        <label  class="form-label">Semester_No</label>
                        <input type="text" class="form-control" placeholder="Enter semester number E.g. 1-1" name="semester_no"  required >
                    </div>
                    <div class="mb-2">
                        <label  class="form-label">Course_Code</label>
                        <input type="text" class="form-control" placeholder="Enter course code" name="course_code"  required >
                    </div>
                      <div class="mb-2">
                        <label  class="form-label">Course_Title</label>
                        <input type="text" class="form-control" placeholder="Enter course title" name="course_title" autocomplete="off" required >
                    </div>
                      <div class="mb-2">
                        <label  class="form-label">Contact_Hours</label>
                        <input type="text" class="form-control" placeholder="Enter contact hours" name="contact_hours" autocomplete="off" required >
                    </div>
                      <div class="mb-2">
                        <label  class="form-label">Credits</label>
                        <input type="text" class="form-control" placeholder="Enter credits" name="credits"  required >
                    </div>
                      <div class="mb-2">
                        <label  class="form-label">Course_Teacher</label>
                        <input type="text" class="form-control" placeholder="Enter course teacher" name="course_teacher"  required >
                    </div>
                    
                      <div class="mb-2 p-2 text-center">
                         <button type="submit" name="submit" class="btn btn-success ">Add</button>
                    </div>
                   
                </form>
            </div>

        <div class="col-sm-3"></div>

        </div>
    </div>
   
    
</body>
</html>