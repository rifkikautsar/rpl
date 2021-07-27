<?php
session_start();
if (!isset($_SESSION["id_pegawai"])){
header("Location: ../../index.php?error=4");
}else if($_SESSION["jabatan"]!="owner"){
    $jabatan = $_SESSION["jabatan"];
    if($jabatan=="pelayan"){
        echo "
        <script>
        alert('Anda tidak memiliki akses ke halaman tersebut');
        document.location.href = '../pelayan/';
        </script>";
        
    }
    if($jabatan=="kasir"){
        echo "
        <script>
        alert('Anda tidak memiliki akses ke halaman tersebut');
        document.location.href = '../kasir/';
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

<?php include("navbar-owner.php"); ?>

<?php
if (isset($_GET['page'])){
    $page = $_GET['page'];

    if ($page == 'home'){
        include "index.php";
    }
    else if ($page == 'laporan'){
        include "laporan.php";
    }
    else if ($page == 'konfirmasi'){
        include "konfirmasi.php";
    }
    else if ($page == 'menu'){
        include "dmenu.php";
    }
    else if ($page == 'getlaporan'){
        include "getlaporan.php";
    }
    else {
        echo "Halaman Tidak Ditemukan!";
    }
    
}
else { ?>
<!---Welcome Page-->
<title>Home | Owner</title>

<body>
    <div class="home">
        <div class="container-fluid-welcome padding">
            <?php 
            include_once("../../functions.php");
            $data = getMenuBaru();
            if(!empty($data)):
            ?>
            <div class="alert alert-warning" role="alert">
                Anda memiliki pengajuan menu baru yang harus ditinjau. Silakan klik <a href="index.php?page=konfirmasi"
                    class="alert-link">disini</a>. Atau Anda dapat klik pada bagian 'Konfirmasi' di Navigasi
            </div>
            <?php endif;?>
            <div class="row welcome text-center pt-5">
                <div class="col-12">
                    <div class="col-12">
                        <h1>Selamat Datang <?=$_SESSION['nama'];?></h1>
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