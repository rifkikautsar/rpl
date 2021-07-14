<!DOCTYPE html>
<html>
<head>
<title>Owner Page</title>
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php include("navbar-pelayan.php"); ?>

<?php
if (isset($_GET['page-pelayan'])){
    $page = $_GET['page-pelayan'];

    if ($page == 'home'){
        include "home-pelayan.php";
    }
    else if ($page == 'dmenu'){
        include "daftar-menu-pelayan.php";
    }
    else if ($page == 'lpesanan'){
        include "lpesanan-pelayan.php";
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
                        <p class = "lead">Selamat datang Pelayan.</p>
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