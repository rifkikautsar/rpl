<!DOCTYPE html>
<html>

<head>
    <title>Owner Page</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include("navbar-kasir.php"); ?>

    <?php
if (isset($_GET['page-kasir'])){
    $page = $_GET['page-kasir'];

    if ($page == 'home'){
        include "index.php";
    }
    else if ($page == 'lpesanan'){
        include "lpesanan-kasir.php";
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
    <div class="bg">
        <div class="container-fluid-welcome padding">
            <div class="row welcome text-center">
                <div class="col-12">
                    <div class="col-12">
                        <p class="lead">Selamat datang Kasir</p>
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