<?php
session_start();
if (!isset($_SESSION["id_pegawai"]))
header("Location: ../../index.php?error=4");
?>
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
        case 'logout':
            include "../../index.php";
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
<title>Home</title>

<body>
    <div class="home">
        <div class="container-fluid-welcome padding">
            <div class="row welcome text-center pt-5">
                <div class="col-12">
                    <div class="col-12">
                        <h1>Selamat Datang <?=$_SESSION['nama']; ?></h1>
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