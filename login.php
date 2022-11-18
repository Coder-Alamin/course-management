<?php
        session_start();

        include 'connect.php';
        

        $user_name = $password = "";
        $user_name_err = $password_err = $login_err = "";
        

        if($_SERVER["REQUEST_METHOD"] == "POST"){
        

            if(empty(trim($_POST["user_name"]))){
                $user_name_err = "Please enter username.";
            } else{
                $user_name = trim($_POST["user_name"]);
            }
            

            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter your password.";
            } else{
                $password = trim($_POST["password"]);
            }

            if(empty($user_name_err) && empty($password_err)){
            
                $sql = "SELECT id, user_name, password FROM user WHERE user_name = ?";
                
                if($stmt = mysqli_prepare($conn, $sql)){
                
                    mysqli_stmt_bind_param($stmt, "s", $param_user_name);
                    
                    $param_user_name = $user_name;
                    
                    if(mysqli_stmt_execute($stmt)){
                         mysqli_stmt_store_result($stmt);
                         
                         if(mysqli_stmt_num_rows($stmt) == 1){                    
                             mysqli_stmt_bind_result($stmt, $id, $user_name, $hashed_password);
                            
                             if(mysqli_stmt_fetch($stmt)){
                               
                                if(password_verify($password, $hashed_password)){
                                    
                                    $_SESSION['login']='true';
                                     header("location: view.php");
                                } else{
                                    $login_err = "Invalid username or password.";
                                }
                            }
                        } else{
                            $login_err = "Invalid username or password.";
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
             mysqli_close($conn);
        }
?>


