<?php
include("navbar.php");
if(isset($_GET['page'])){
    $page = $_GET['page'];

    switch($page){
        case 'home':
            include "home.php";
            break;
        case 'login':
            include "login.php";
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
}else{
    include("home.php");
}
include("footer.php");

?>