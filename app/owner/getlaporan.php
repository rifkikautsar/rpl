<style>
@media print {
    footer {
        visibility: hidden;
    }

    .navbar-container {
        visibility: hidden;
    }

    #pilihan {
        visibility: hidden;
    }

    .cetak {
        visibility: hidden;
    }

    .save {
        visibility: hidden;
    }

    @page {
        margin: 0;
    }

    body {
        margin: 2cm;
    }
}
</style>

<?php
if(isset($_POST['bulan'])){
include_once("../../functions.php");
$db=dbConnect();
$tahun = $_POST['tahun'];
$bulan = $_POST['bulan'];
function bulan($bulan){
    if($bulan==1) echo "Januari";
    else if($bulan==2) echo "Februari";
    else if($bulan==3) echo "Maret";
    else if($bulan==4) echo "April";
    else if($bulan==5) echo "Mei";
    else if($bulan==6) echo "Juni";
    else if($bulan==7) echo "Juli";
    else if($bulan==8) echo "Agustus";
    else if($bulan==9) echo "September";
    else if($bulan==10) echo "Oktober";
    else if($bulan==11) echo "November";
    else if($bulan==12) echo "Desember";
}
?>

<div class="justify-content-center">
    <h5>Periode Bulan : <?=bulan($bulan);?> <?=$tahun;?></h5>
    <div class="row">
        <table class="table table-striped table-hover rounded" style="min-width: 700px; max-width: 50%;">
            <thead>
                <th colspan="3" class="text-center">Rincian Pemasukan</th>
                <tr>
                    <th>Menu</th>
                    <th>Terjual</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <?php
                $sql = "SELECT id_menu, nama from menu";
                $res = $db->query($sql);
                $data = $res->fetch_all(MYSQLI_ASSOC);
                foreach($data as $row){
                    $id_menu = $row['id_menu'];
                ?>
            <tr>
                <td><?=$row['nama'];?></td>
                <td>
                    <?php
            $sql = "SELECT * from rincian_pesanan join pemesanan using(id_pesanan) where id_menu='$id_menu' and MONTH(pemesanan.`tgl_pesan`)='$bulan'";
            $res = $db->query($sql);
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $count = 0;
            //hitung jml pesanan per menu
            foreach($data as $list){
                $count += $list['jml_pesanan'];
            }
            echo $count;
            ?>
                </td>
                <td><?php
        $count = 0;
        foreach($data as $list){
            $count += $list['sub_total'];
        }
        echo "Rp. ".number_format($count,0,',','.');
        ?></td>
            </tr>
            <?php
            }
            ?>
            <thead>
                <th class="text-center" colspan="3">Laporan Pemasukan</th>
                <tr>
                    <th>Jumlah Pembeli</th>
                    <th></th>
                    <th>Total Pemasukan</th>
                </tr>
            </thead>
            <?php 
            $sql = "SELECT pemesanan.tgl_pesan, pembayaran.total_bayar, pembayaran.id_pesanan FROM pembayaran JOIN pemesanan USING(id_pesanan) WHERE MONTH(pemesanan.`tgl_pesan`)='$bulan'";
            $res = $db->query($sql);
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $jmlPembeli = 0;
            $total = 0;
            foreach($data as $row){
            $jmlPembeli += 1;
            $total += $row['total_bayar'];
            };
            ?>
            <tr>
                <td><?=$jmlPembeli;?></td>
                <td></td>
                <td>Rp. <?=number_format($total,0,',','.');?></td>
            </tr>
        </table>
    </div>
    <button type="button" class="btn btn-success cetak">Cetak</button>
    <!-- <button type="submit" class="btn btn-success save">Save</button> -->
</div>


<?php } ?>
<script>
$(document).ready(function() {
    $(".cetak").on("click", function() {
        window.print()
    });
});
// $(document).ready(function() {
//     $(".save").on("click", function() {
//         var bulan = $("#bulan").val();
//         var tahun = $("#tahun").val();
//         $.ajax({
//             url: "excel.php",
//             method: "post",
//             data: {
//                 bulan: bulan,
//                 tahun: tahun
//             },
//             success: function(data) {

//             }
//         });
//     });
// });
</script>