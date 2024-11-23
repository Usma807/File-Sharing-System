<?php
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
require_once "config.php";
 
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Iltimos, foydalanuvchi nomini kiriting.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Iltimos, parolingizni kiriting.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT user_id, user_role, user_fullname, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $role, $fullname, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $id;
                            $_SESSION["role"] = $role;
                            $_SESSION["fullname"] = $fullname;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: welcome.php");
                        } else{
                            $login_err = "Yaroqsiz foydalanuvchi nomi yoki parol.";
                        }
                    }
                } else{
                    $login_err = "Yaroqsiz foydalanuvchi nomi yoki parol.";
                }
            } else{
                echo "Voy! Nimadir noto'g'ri bajarildi. Iltimos keyinroq qayta urinib ko'ring.";
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Kirish </title>
    <?php include 'partials/headtags.php'; ?>

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <span class="fw-bold " style="font-family: Sofia,sans-serif;"> <span
                                        class="fs-1 font-effect-shadow-multiple">Info</span> <span
                                        class="text-primary fs-4 font-effect-shadow-multiple">Dars</span> </span>
                            </div>
                            <h4>Salom! Qani boshladik</h4>
                            <h6 class="fw-light">Davom etish uchun tizimga kiring.</h6>

                            <form class="pt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                method="post">
                                <?php 
                          if(!empty($login_err)){
                              echo '<div class="alert alert-danger">' . $login_err . '</div>';
                          }        
                          ?>
                                <div class="form-group">
                                    <input type="text" name="username"
                                        class="form-control  form-control-lg <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                                        value="<?php echo $username; ?>" placeholder="Foydalanuvchi nomi">
                                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                                        placeholder="Parol">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                </div>
                                <div class="mt-3">
                                    <input type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        value="Kirish">
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Meni eslab qol
                                        </label>
                                    </div>
                                    <a href="#" class="auth-conn text-black">Parolni unutdingizmi?</a>
                                </div>
                                <div class="mb-2">
                                    <button type="button" class="btn btn-block btn-facebook auth-form-btn disabled">
                                        <i class="ti-facebook me-2"></i>Facebook orqali ulaning
                                    </button>
                                </div>
                                <div class="text-center mt-4 fw-light">
                                Hisobingiz yo'qmi? <a href="register.php" class="text-primary">Yaratish</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'partials/javascripts.php'; ?>

</body>

</html>