<?php
include_once("navbar-pelayan.php");
?>
<?php
if(isset($_GET['page'])){
    $page = $_GET['page'];

    switch($page){
        case 'home':
            include "index.php";
            break;
        case 'menu':
            include "menu2.php";
            break;
        case 'about':
            include "about.php";
            break;
        case 'contact':
            include "contact.php";
            break;    
        default:
        echo "Halaman Tidak ditemukan";
    }
}
else { ?>
<!---Welcome Page-->
<div class="bg">
    <div class="container-fluid-welcome padding">
        <div class="row welcome text-center">
            <div class="col-12">
                <div class="col-12">
                    <p class="lead">Selamat datang Pelayan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<?php
include_once("../../footer.php");
?>