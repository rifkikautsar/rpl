<?php  
 include("../../functions.php");
 $db=dbConnect();
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $nama = mysqli_real_escape_string($db, $_POST["nama"]);  
      $harga = mysqli_real_escape_string($db, $_POST["harga"]);  
      $stok = mysqli_real_escape_string($db, $_POST["stok"]);     
      if($_POST["id_menu"] != '')  
      {  
           $query = "  
           UPDATE menu   
           SET nama='$nama',   
           harga='$harga',   
           stok='$stok'      
           WHERE id_menu='".$_POST["id_menu"]."'";  
           $message = 'Data Updated';  
      }  
    //   else  
    //   {  
    //        $query = "  
    //        INSERT INTO tbl_employee(name, address, gender, designation, age)  
    //        VALUES('$name', '$address', '$gender', '$designation', '$age');  
    //        ";  
    //        $message = 'Data Inserted';  
    //   }  
      if(mysqli_query($db, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
        //    $select_query = "SELECT * FROM tbl_employee ORDER BY id DESC";  
        //    $result = mysqli_query($connect, $select_query);  
        //    $output .= '  
        //         <table class="table table-bordered">  
        //              <tr>  
        //                   <th width="70%">Employee Name</th>  
        //                   <th width="15%">Edit</th>  
        //                   <th width="15%">View</th>  
        //              </tr>  
        //    ';  
        //    while($row = mysqli_fetch_array($result))  
        //    {  
        //         $output .= '  
        //              <tr>  
        //                   <td>' . $row["name"] . '</td>  
        //                   <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
        //                   <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
        //              </tr>  
        //         ';  
        //    }  
        //    $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>