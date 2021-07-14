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
<body>
    <div class="home">
        <div class="container-fluid-welcome padding">
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