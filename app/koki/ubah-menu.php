<?php  
 include("../../functions.php");
 $db=dbConnect();
 $message = '';
 if(!isset($_POST['id_menu'])){
      $message = "ERROR";
 }
 if(isset($_POST['id_menu']))  
 {  
     $nama = mysqli_real_escape_string($db, $_POST["nama"]);  
     $keterangan = mysqli_real_escape_string($db, $_POST["keterangan"]);  
     $harga = mysqli_real_escape_string($db, $_POST["harga"]);
     $stok = mysqli_real_escape_string($db, $_POST["stok"]);
     $id_menu = mysqli_real_escape_string($db, $_POST["id_menu"]);
      if($id_menu != '')
      {  
          $query = "UPDATE menu set nama='$nama', harga='$harga', stok='$stok',
          keterangan='$keterangan' where id_menu='$id_menu'"; 
           $res = $db->query($query);
           if($res){
               $message = 'OK';
           }else{
                $message = "ERROR";
           }
      }
 }
 echo $message;
 ?>