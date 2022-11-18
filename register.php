<?php

 include 'connect.php';
 

$user_name = $password = $confirm_password = "";
$user_name_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["user_name"]))){
        $user_name_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["user_name"]))){
        $user_name_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        
        $sql = "SELECT id FROM user WHERE user_name = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_user_name);
            
           
            $param_user_name = trim($_POST["user_name"]);
            
           
            if(mysqli_stmt_execute($stmt)){
              
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $user_name_err = "This username is already taken.";
                } else{
                    $user_name = trim($_POST["user_name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 4){
        $password_err = "Password must have at least 4 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    
    if(empty($user_name_err) && empty($password_err) && empty($confirm_password_err)){
        
        
        $sql = "INSERT INTO user (user_name, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_user_name, $param_password);
            
            
            $param_user_name = $user_name;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: login.php?user_created");
            } else{
                echo "Error! Something went wrong. Please try again later.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
   
    mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>

            <div class="col-sm-6 pt-1 mt-5 border border-success">
                <div class="mb-2">
                      <h4 class="text-center bg-success text-white p-1">Registration Information</h4>
                </div>

               <form action="register.php" method="POST">
                 <div class="mb-3 form-group">
                        <label>User name</label>
                        <input type="text" name="user_name" class="form-control <?php echo (!empty($user_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_name; ?>">
                        <span class="invalid-feedback"><?php echo $user_name_err; ?></span>
                 </div>    
                 <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                 </div>
                 <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                   </div>
                    <div class="mb-3 mt-3 text-center">
                        <button type="submit" class="btn btn-success" name="submit" >Register</button>
                    </div>              

                </form>

            </div>

            <div class="col-sm-3"></div>

        </div>
         <div class="row">
            <div class="col-sm-2" ></div>
            <div class="col-sm-9 mt-3">
                 <div class="mb-3 text-center">
                           <span>Have an account? </span>
                            <button type="submit" class="btn btn-primary">
                                <a href="login.php" class="text-white text-decoration-none">Login</a></button>
                            </div>

            </div>
           
                
            </div>
    </div>
   
    
</body>
</html>