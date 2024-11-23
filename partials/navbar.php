<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="index.php">
                <span class="fw-bold " style="font-family: Sofia,sans-serif;"> <span class="fs-2 font-effect-shadow-multiple" >Info</span> <span class="text-primary fs-5 font-effect-shadow-multiple">Dars</span> </span>
            </a>
        </div>
    </div>
    <?php
                      $id = $_SESSION['user_id'];
                      $sql = "SELECT * from users where user_id = $id";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                         ?>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">
                    <?php
date_default_timezone_set('Asia/Kolkata'); 

$currentHour = date('G');

$greeting = '';

if ($currentHour >= 5 && $currentHour < 12) {
    $greeting = 'Salom';
} elseif ($currentHour >= 12 && $currentHour < 18) {
    $greeting = 'Salom';
} else {
    $greeting = 'Salom';
}

echo $greeting;
?>,

                    <span class="text-black fw-bold text-capitalize">
                        <?=$row['user_fullname']?>
                    </span>
                </h1>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Qidiruv" title="Search Here">
                </form>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="icon-open"></i>
                    
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                    aria-labelledby="countDropdown">
                    <a class="dropdown-item py-3">
                        <p class="mb-0 font-weight-medium float-left">Web Sayt </p>
                        <span class="badge badge-pill badge-primary float-right">Ko'rish</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item" href="tutorials-page.php">
                    <i class="icon-book"></i>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Darsliklar </p>
                            <p class="fw-light small-text mb-0"> Qo'llanmalar </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item" href="live-lessons.php">
                    <i class="icon-video"></i>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Jonli Darslar </p>
                            <p class="fw-light small-text mb-0"> Davom etmoqda.. </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item" href="courses-page.php">
                    <i class="icon-star"></i>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Kurslar </p>
                            <p class="fw-light small-text mb-0"> Bepul </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item" href="methodic-documents.php">
                    <i class="icon-download"></i>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Metodik Hujjatlar </p>
                            <p class="fw-light small-text mb-0"> Yuklab oling </p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="images/user.webp" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="images/user.webp" style="width:60px" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold text-capitalize"><?=$row['user_fullname']?></p>
                        <p class="fw-light text-muted mb-0"><?=$row['user_email']?></p>
                    </div>
                   
                    <a href="php/logout.php" class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Chiqish</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
    <?php
                        }
                      } else {
                        echo "0 natija";
                      }
                      ?>
</nav>