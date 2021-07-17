<?php
if(isset($_POST['bulan'])){
include_once("../../functions.php");
$db=dbConnect();
$bulan = $_POST['bulan'];
$sql = "SELECT pemesanan.tgl_pesan, pembayaran.total_bayar FROM pembayaran JOIN pemesanan USING(id_pesanan) WHERE MONTH(pemesanan.`tgl_pesan`)='$bulan'";
$res = $db->query($sql);
?>
<table class="table table-striped table-hover rounded" style="min-width: 700px; max-width: 50%;">
    <thead>
        <tr>
            <td rowspan="2">Periode 1</td>
        <tr>
            <td>Tanggal</td>
            <td>Tanggal</td>
        </tr>
        </tr>
    </thead>
    <?php 
    $data = $res->fetch_all(MYSQLI_ASSOC);
    foreach($data as $row) :
    ?>
    <tr>
        <td><?=$row['tgl_pesan']; ?></td>
        <td><?=$row['total_bayar']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php } ?>