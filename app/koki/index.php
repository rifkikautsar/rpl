<?php
include_once("navbar-koki.php");
?>
<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];

    switch($page){
        case 'home':
            include "index.php";
            break;
        case 'form':
            include "form-menu.php";
            break;
        case 'pesanan':
            include "pesanan.php";
            break;
        case 'menu':
            include "dmenu.php";
            break;
        default:
        echo "Halaman Tidak ditemukan";
    }
}
else { ?>
<title>Home | Koki</title>
<!---Welcome Page-->

<body>
    <div class="home">
        <div class="container-fluid-welcome padding">
            <?php 
            include_once("../../functions.php");
            $data = getDaftarPesananKoki();
            if(!empty($data)):
            ?>
            <div class="alert alert-warning" role="alert">
                Anda memiliki pesanan baru!
            </div>
            <?php endif;?>
            <div class="row welcome text-center pt-5">
                <div class="col-12">
                    <div class="col-12">
                        <h1>Selamat Datang Koki</h1>
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