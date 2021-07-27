<?php
session_start();
if (!isset($_SESSION["id_pegawai"])){
header("Location: ../../index.php?error=4");
}else if($_SESSION["jabatan"]!="pelayan"){
    $jabatan = $_SESSION["jabatan"];
    if($jabatan=="owner"){
        echo "
        <script>
        alert('Anda tidak memiliki akses ke halaman tersebut');
        document.location.href = '../owner/';
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
        case 'pesanan':
            include "pesanan.php";
            break;    
        default:
        echo "Halaman Tidak ditemukan";
    }
}
else { ?>
<!---Welcome Page-->
<title>Home</title>
<?php
include_once("../../functions.php");
$db=dbConnect();
$sql="SELECT * from pemesanan where ket='pickup'";
$res=$db->query($sql);
    if($res){
        $data = $res->fetch_all(MYSQLI_ASSOC);
    }else echo "GAGAL SQL : ".$db->error
?>

<body>
    <div class="home">
        <div class="container-fluid-welcome padding">
            <?php if(!empty($data)): ?>
            <div class="alert alert-warning" role="alert">
                Anda memiliki pesanan yang harus di pickup.
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