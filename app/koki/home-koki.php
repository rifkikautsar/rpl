<!DOCTYPE html>
<html>
<head>
<title>Owner Page</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php include("navbar-koki.php"); ?>

<?php
if (isset($_GET['page-koki'])){
    $page = $_GET['page-koki'];

    if ($page == 'home'){
        include "home-koki.php";
    }
    else if ($page == 'dmenu'){
        include "daftar-menu-koki.php";
    }
    else if ($page == 'form-menu'){
        include "form-menu.php";
    }
    else if ($page == 'lpesanan'){
        include "lpesanan.php";
    }
    else if ($page == 'logout'){
        include "../home.php";
    }
    else {
        echo "Halaman Tidak Ditemukan!";
    }
    
}
else { ?>
        <!---Welcome Page-->
        <div class ="bg">
            <div class = "container-fluid-welcome padding">
                <div class = "row welcome text-center">
                    <div class = "col-12">
                        <div class = "col-12">
                        <p class = "lead">Selamat datang Koki</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
}
?>
</body>
</html>