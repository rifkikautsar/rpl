<?php
include("../../functions.php");
$keyword = $_GET["keyword"];
$db=dbConnect();
$sql = "SELECT p.id_pesanan,p.no_meja,p.tgl_pesan,pel.nama,pel.id_pelanggan from pemesanan p join pelanggan pel using(id_pelanggan) where p.no_meja like '%$keyword%' or pel.nama like '%$keyword%' or p.id_pesanan like '%$keyword%' or p.tgl_pesan like '%$keyword%' and p.status = 'belum'";
//$sql = "SELECT * from pemesanan where id_pesanan like '%$keyword%'";
$res=$db->query($sql);
$list=$res->fetch_all(MYSQLI_ASSOC);
?>
<div class="col-xl-10 col-lg-8">
    <div class=" card shadow mb-1">
        <div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pesanan</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body p-0 container">
            <table class="table table-borderless table-responsive-md">
                <tr>
                    <th style="width: 15%; text-align: center;">ID Pesanan</th>
                    <th style="width: 30%; text-align: center;">Atas Nama</th>
                    <th style="width: 15%; text-align: center;">No Meja</th>
                    <th style="width: 15%; text-align: center;">Tanggal</th>
                    <th style="width: 25%; text-align: center;" colspan="2">Aksi</th>
                </tr>
                <form action="menu" method="POST">
                    <?php foreach($list as $row): ?>
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
                        <td style="text-align: center;" colspan="2">
                            <button type="button" class="btn btn-primary view-data" value="view"
                                id="<?=$row['id_pesanan'];?>">
                                Detail</button>&emsp;
                            <button type="submit" class="btn btn-success edit-data" value="edit"
                                id="<?=$row['id_pesanan'];?>">
                                Edit</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </form>
            </table>
            <!-- Modal Detail -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Pesanan Anda</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body detail">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>