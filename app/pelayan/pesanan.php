<title>List Pesanan</title>
<style>
.main {
    min-height: 100vh;
}
</style>

<body>
    <?php
include_once("../../functions.php");
$db=dbConnect();
if($db->connect_errno == 0){
?>
    <div class="h-100 pt-4 main">
        <form action="menu" method="POST">
            <h3 class="text-center">List Pesanan</h3>
            <center>
                <form action="" method="post">
                    <input type="text" autocomplete="off" name="keyword" id="keyword" placeholder="Pencarian"
                        class="cari mb-1">
                </form>
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
                                        <th style="width: 25%; text-align: center;" colspan="2">Aksi</th>
                                    </tr>
                                    <?php $list = getDaftarPesanan(); ?>
                                    <?php foreach($list as $row): ?>
                                    <form action="menu" method="POST">
                                        <tr>
                                            <input type="hidden" name="kd_meja" value="<?=$row['no_meja'];?>">
                                            <input type="hidden" name="nama_pelanggan" value="<?=$row['nama'];?>">
                                            <input type="hidden" name="id_pesanan" value="<?=$row['id_pesanan'];?>">
                                            <input type="hidden" name="id_pel" value="<?=$row['id_pelanggan'];?>">
                                            <td style="text-align: center;"><?=$row['id_pesanan'];?></td>
                                            <td style="text-align: center;"><?=$row['nama'];?></td>
                                            <td style="text-align: center;"><?=$row['no_meja'];?></td>
                                            <td style="text-align: center;">
                                                <?=date("d-m-Y",strtotime($row['tgl_pesan']));?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php if($row['ket']=='pickup'){ ?>
                                                <button type="button" class="btn btn-success selesai"
                                                    id="<?=$row['id_pesanan'];?>" name="selesai">
                                                    <?=strtoupper($row['ket']);?></button>
                                                <?php }else{
                                                echo strtoupper($row['ket']);
                                            } ?>
                                            </td>
                                            <td style="text-align: center;" colspan="2">
                                                <button type="button" class="btn btn-primary view-data" value="view"
                                                    id="<?=$row['id_pesanan'];?>">
                                                    Detail</button>&emsp;
                                                <button type="submit" class="btn btn-danger edit-data" value="edit"
                                                    id="<?=$row['id_pesanan'];?>">
                                                    Edit</button>
                                            </td>
                                        </tr>
                                    </form>
                                    <?php endforeach; ?>
                                </table>
                                <!-- Modal Detail -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Pesanan Anda</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body detail">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </form>
    </div>
</body>
<?php } ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $(".view-data").on("click", function() {
        var id_pesanan = $(this).attr("id");
        $.ajax({
            url: "getdetail.php",
            method: "post",
            data: {
                id_pesanan: id_pesanan
            },
            success: function(data) {
                $(".detail").html(data);
                $("#staticBackdrop").modal("show");
            }
        })
    });
    $(".selesai").on("click", function() {
        var id_pesanan = $(this).attr("id");
        $.ajax({
            url: "selesai.php",
            method: "post",
            data: {
                id_pesanan: id_pesanan
            },
            success: function(data) {
                Swal.fire({
                    position: 'top-center',
                    title: 'Pesanan selesai diantar',
                    icon: 'success',
                    showConfirmButton: true,
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = "pesanan"
                    }
                })
            }
        })
    });
});
$(document).ready(function() {
    $("#keyword").on('keyup', function() {
        $("#container").load("cari.php?keyword=" + $("#keyword").val());
    });
});
</script>