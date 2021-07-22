<?php
session_start();
if (!isset($_SESSION["id_pegawai"])){
header("Location: ../../index.php?error=4");
}else if($_SESSION["jabatan"]!="kasir"){
    $jabatan = $_SESSION["jabatan"];
    if($jabatan=="owner"){
        echo "
        <script>
        alert('Anda tidak memiliki akses ke halaman tersebut');
        document.location.href = '../owner/';
        </script>";
        
    }
    if($jabatan=="pelayan"){
        echo "
        <script>
        alert('Anda tidak memiliki akses ke halaman tersebut');
        document.location.href = '../pelayan/';
        </script>";
        
    }
    if($jabatan=="koki"){
        echo "
        <script>
        alert('Anda tidak memiliki akses ke halaman tersebut');
        document.location.href = '../koki/';
        </script>";
        
    }
}
?>
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