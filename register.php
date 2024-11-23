<?php
require_once "config.php";
 
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Iltimos, foydalanuvchi nomini kiriting.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Foydalanuvchi nomi faqat harflar, raqamlar va pastki chiziqdan iborat bo'lishi mumkin.";
    } else{
        $sql = "SELECT user_id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Bu foydalanuvchi nomi allaqachon olingan.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Voy! Nimadir noto'g'ri bajarildi. Iltimos keyinroq qayta urinib ko'ring.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Iltimos, parol kiriting.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Parol kamida 6 ta belgidan iborat bo'lishi kerak.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Iltimos, parolni tasdiqlang.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Parol mos kelmadi.";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        $sql = "INSERT INTO users (user_fullname, user_email, user_phone , user_pin, username, password) VALUES (?, ?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ssisss", $name, $email, $phone, $pin,  $param_username, $param_password);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $name = $_REQUEST['name'];
            $phone = $_REQUEST['phone'];
            $email = $_REQUEST['email'];
            $pin = password_hash($_REQUEST['pin'], PASSWORD_DEFAULT);
            
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
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
    <title> Ro'yxatdan o'tish </title>
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
                            <h6 class="fw-light">Davom etish uchun roʻyxatdan oʻting.</h6>
                            <form class="pt-3" autocomplete="off"
                                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="To'liq ism">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="phone" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Tel">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="pin" maxlength="4" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="PIN">
                                    <small class="text-secondary">PIN-kod hujjatlarni qulflash yoki ochish uchun ishlatiladi.</small>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username"
                                        class="form-control form-control-lg <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                                        value="<?php echo $username; ?>" placeholder="Foydalanuvchi nomi">
                                    <span class="invalid-feedback"><?php echo $username_err; ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                                        value="<?php echo $password; ?>" placeholder="Parol">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm_password"
                                        class="form-control form-control-lg <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                                        value="<?php echo $confirm_password; ?>" placeholder="Parolni tasdiqlash">
                                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                </div>
                                <div class="mt-3">
                                    <input type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        value="SIGN UP">
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
                                Hisobingiz bormi? <a href="index.php" class="text-primary">Kirish</a>
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