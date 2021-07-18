<?php
if(isset($_POST['id_menu'])){
    include_once("../../functions.php");
    $db=dbConnect();
    $id_menu = $_POST['id_menu'];
    //ambil nama file
    $sql = "SELECT menu.file from menu where id_menu='$id_menu'";
    $res=$db->query($sql);
    $data = $res->fetch_assoc();
    $file = $data['file'];
    if(file_exists($_SERVER["DOCUMENT_ROOT"]."/data/rpl/app/assets/images/$file")){
        unlink($_SERVER["DOCUMENT_ROOT"]."/data/rpl/app/assets/images/$file");
        $sql = "DELETE from menu where id_menu = '$id_menu'";
        $res=$db->query($sql);
        if($res){
            echo "
            <script>
            alert('Menu baru berhasil dibatalkan');
            document.location.href = 'konfirmasi';
            </script>";
        }else{
            echo "
            <script>
            alert('Gagal membatalkan menu baru');
            </script>";
        }
    }else{
        $sql = "DELETE from menu where id_menu = '$id_menu'";
        $res=$db->query($sql);
        if($res){
            echo "
            <script>
            alert('Menu baru berhasil dibatalkan');
            document.location.href = 'konfirmasi';
            </script>";
        }else{
            echo "
            <script>
            alert('Gagal membatalkan menu baru');
            </script>";
        }
    }
}
?>