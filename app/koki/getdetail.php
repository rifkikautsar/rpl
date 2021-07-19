<?php
if(isset($_POST['id_menu'])){
    include("../../functions.php");
    $db=dbConnect();
    $id_menu=$_POST['id_menu'];
    $sql="SELECT * from menu where menu.status='disajikan' and id_menu = '$id_menu'";
    $res=$db->query($sql);
    $k=$res->fetch_assoc();
echo json_encode($k);
};
?>