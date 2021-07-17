<title>List Pesanan</title>
<style>

</style>

<body>
    <?php
include_once("../../functions.php");
$db=dbConnect();
if($db->connect_errno == 0){
    if(isset($_POST['pickup'])){
        $id_pesanan = $_POST['id_pesanan'];
        $sql = "UPDATE pemesanan SET ket='pickup' where id_pesanan='$id_pesanan'";
        $res = $db->query($sql);
        if($res){
            
        }else echo "GAGAL EKSEKUSI SQL".$db->error;
    }
?>
    <div class="h-100 pt-4">
        <h3 class="text-center">List Pesanan</h3>
        <center>

            <input type="text" autocomplete="off" name="keyword" id="keyword" placeholder="Pencarian" class="cari mb-1">

            <div id="container">
                <div class="col-xl-10 col-lg-8">
                    <div class="card shadow mb-1">
                        <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Pesanan</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body p-0">
                            <table class="table table-borderless table-responsive-md">
                                <tr>
                                    <th style="width: 15%; text-align: center;">ID Pesanan</th>
                                    <th style="width: 25%; text-align: center;">Atas Nama</th>
                                    <th style="width: 10%; text-align: center;">No Meja</th>
                                    <th style="width: 15%; text-align: center;">Tanggal</th>
                                    <th style="width: 10%; text-align: center;">Keterangan</th>
                                    <th style="width: 25%; text-align: center;">Aksi</th>
                                </tr>
                                <?php $list = getDaftarPesanan(); ?>
                                <?php foreach($list as $row): ?>
                                <form action="" method="post">
                                    <tr>
                                        <input type="hidden" name="kd_meja" value="<?=$row['no_meja'];?>">
                                        <input type="hidden" name="nama_pelanggan" value="<?=$row['nama'];?>">
                                        <input type="hidden" name="id_pesanan" value="<?=$row['id_pesanan'];?>">
                                        <input type="hidden" name="id_pel" value="<?=$row['id_pelanggan'];?>">
                                        <td style="text-align: center;"><?=$row['id_pesanan'];?></td>
                                        <td style="text-align: center;"><?=$row['nama'];?></td>
                                        <td style="text-align: center;"><?=$row['no_meja'];?></td>
                                        <td style="text-align: center;"><?=date("d-m-Y",strtotime($row['tgl_pesan']));?>
                                        </td>
                                        <td style="text-align: center;"><?=strtoupper($row['ket']);?></td>
                                        <td style="text-align: center;">
                                            <?php if($row['ket']=='pickup' || $row['ket']=='selesai'){ ?>
                                            <center>
                                                Telah di Pickup
                                            </center>
                                            <?php } else if($row['ket']=="proses"){ ?>
                                            <center>
                                                <button type="submit" class="btn btn-primary justify-content-center"
                                                    name="pickup">
                                                    Pickup</button>
                                            </center>
                                            <?php }; ?>
                                        </td>
                                    </tr>
                                </form>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </center>
    </div>
</body>
<?php }else {
    echo "ERROR koneksi DATABASE : ".$db->connect_error;
}
?>
<script>
// $(document).ready(function() {
//     $(".view-data").on("click", function() {
//         var id_pesanan = $(this).attr("id");
//         $("#staticBackdrop").modal("show");
//     });
// });
// var keyword = document.getElementById('keyword');
// var container = document.getElementById('container');
// keyword.addEventListener('keyup', function() {

//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             container.innerHTML = xhr.responseText;
//         }
//     }
//     xhr.open("GET", "cari.php?keyword=" + keyword.value, true);
//     xhr.send();
// })
$(document).ready(function() {
    $("#keyword").on('keyup', function() {
        $("#container").load("cari.php?keyword=" + $("#keyword").val());
    });
});
</script>