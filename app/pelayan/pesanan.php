<title>List Pesanan</title>

<body>
    <?php
include_once("../../functions.php");
$db=dbConnect();
?>
    <div class="h-100 text-center pt-4">
        <h3>List Pesanan</h3>
        <center>
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
                                <th style="width: 30%; text-align: center;">Atas Nama</th>
                                <th style="width: 15%; text-align: center;">No Meja</th>
                                <th style="width: 15%; text-align: center;">Tanggal</th>
                                <th style="width: 25%; text-align: center;" colspan="2">Aksi</th>
                            </tr>
                            <?php $list = getDaftarPesanan(); ?>
                            <?php foreach($list as $row): ?>
                            <tr>
                                <td style="text-align: center;"><?=$row['id_pesanan'];?></td>
                                <td style="text-align: center;"><?=$row['nama'];?></td>
                                <td style="text-align: center;"><?=$row['no_meja'];?></td>
                                <td style="text-align: center;"><?=date("d-m-Y",strtotime($row['tgl_pesan']));?></td>
                                <td style="text-align: center;" colspan="2">
                                    <button type="button" class="btn btn-primary view-data" value="view"
                                        id="<?=$row['id_pesanan'];?>">
                                        Detail</button>&emsp;
                                    <button class="btn btn-info">Edit</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </table>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body detail">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
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
                $("#exampleModal").modal("show");
            }
        })
    });
});
</script>