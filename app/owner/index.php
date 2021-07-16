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
    else if ($page == 'dmenu'){
        include "dmenu.php";
    }
    else {
        echo "Halaman Tidak Ditemukan!";
    }
    
}
else { ?>
<!---Welcome Page-->
<title>Home</title>

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
                        <h1>Selamat Datang Bos</h1>
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