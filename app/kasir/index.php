<?php include("navbar-kasir.php"); ?>
<?php
if (isset($_GET['page'])){
    $page = $_GET['page'];

    if ($page == 'home'){
        include "index.php";
    }
    else if ($page == 'pesanan'){
        include "lpesanan-kasir.php";
    }
    else if($page == 'transaksi'){
        include "transaksi.php";
    }
    else {
        echo "Halaman Tidak Ditemukan!";
    }
    
}
else { ?>
<!---Welcome Page-->
<title>Home | Kasir</title>

<body>
    <div class="home">
        <div class="container-fluid-welcome padding">
            <div class="row welcome text-center pt-5">
                <div class="col-12">
                    <div class="col-12">
                        <h1>Selamat Datang Kasir</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
}
?>
<?php
include_once("../../footer.php");
?>