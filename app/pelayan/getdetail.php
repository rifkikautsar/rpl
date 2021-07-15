<?php
if(isset($_POST['id_pesanan'])){
    $output = '';
    include("../../functions.php");
    $db=dbConnect();
    $k = getRincianPesanan($_POST['id_pesanan']);
    $total = 0;
    $output .= "
    <table class='table table-borderless'>";
    foreach($k as $row){
        $total += $row['sub_total'];
        $output .= '
        <tr>
            <td>'.$row["nama"].'</td>
            <td>'.$row["jml_pesanan"].'</td>
            <td>'.$row["sub_total"].'</td>
        </tr>';
    }
    $output .= "<tr>
    <td colspan=3 align='center'>
        Total Bayar :
    </td>
    <td colspan='2' align='center' class='font-weight-bold text-primary'>
        Rp.".number_format($total,2,",",".")."</td></tr>";
$output .= "</table>";
echo $output;
};
?>