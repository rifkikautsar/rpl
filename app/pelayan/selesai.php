<?php
if(isset($_POST['id_pesanan'])){
    include("../../functions.php");
    $db=dbConnect();
    $id_pesanan = $_POST['id_pesanan'];
    if($db->connect_errno==0){
        $sql = "UPDATE pemesanan SET ket='selesai' where id_pesanan='$id_pesanan'";
        $res = $db->query($sql);
        $res->free();
    }else echo "GAGAL KONEKSI : ".$db->connect_error;
}
?>