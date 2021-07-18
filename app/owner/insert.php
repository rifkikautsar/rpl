<?php
if(isset($_POST['id_menu'])){
    include("../../functions.php");
    $db=dbConnect();
    $id_menu=$_POST['id_menu'];
    $sql="UPDATE menu set menu.status='disajikan' where id_menu='$id_menu'";
    $res=$db->query($sql);
    $res->free();
};
?>