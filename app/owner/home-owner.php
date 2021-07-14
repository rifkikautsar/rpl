<!DOCTYPE html>
<html>
<head>
<title>Owner Page</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php include("navbar-owner.php"); ?>

<?php
if (isset($_GET['page-owner'])){
    $page = $_GET['page-owner'];

    if ($page == 'home'){
        include "home-owner.php";
    }
    else if ($page == 'laporan'){
        include "laporan.php";
    }
    else if ($page == 'konfirmasi'){
        include "konfirmasi-menu.php";
    }
    else if ($page == 'dmenu'){
        include "daftar-menu-owner.php";
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
                        <p class = "lead">Selamat datang Pak Resto.</p>
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