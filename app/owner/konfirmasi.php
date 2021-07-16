<title>Konfirmasi Menu Baru</title>

<body>
    <div class="container h-100">
        <div class="row justify-content-center">
            <?php
include_once ("../../functions.php");
$db=dbConnect();
if(isset($_POST['setuju'])){
    $id_menu = $_POST['id_menu'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $sql = "REPLACE into menu values('$id_menu','$nama','$harga','$stok','Cendol ....','disajikan')";
    $res=$db->query($sql);

    if($res){
        echo "
        <script>
        alert('Menu baru berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }else{
        echo "
        <script>
        alert('Gagal menambahkan menu baru');
        </script>";
    }
};
if(isset($_POST['batal'])){
    $id_menu = $_POST['id_menu'];
    $sql = "DELETE from menu where id_menu = '$id_menu'";
    $res=$db->query($sql);
    if($res){
        echo "
        <script>
        alert('Menu baru berhasil dibatalkan');
        document.location.href = 'index.php';
        </script>";
    }else{
        echo "
        <script>
        alert('Gagal membatalkan menu baru');
        </script>";
    }
}

$data = getMenuBaru();
if(!empty($data)){
?>
            <!-- <tr>
                    <th style="width: 15%; text-align: center;">ID Menu</th>
                    <th style="width: 40%; text-align: center;">Nama Menu</th>
                    <th style="width: 10%; text-align: center;">Harga</th>
                    <th style="width: 10%; text-align: center;">Stok</th>
                    <th style="width: 25%; text-align: center;" colspan="2">Aksi</th>
                </tr> -->
            <form action="" method="POST">
                <div class="card shadow mb-4">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php foreach($data as $row):?>
                        <input type="hidden" name="id_menu" value="<?=$row['id_menu']; ?>">
                        <div class="card mb-3" style="max-width: 768px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../assets/images/M01.jpg" class="img-fluid rounded-start" alt="..."
                                        style="width: 480px; height: 200px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$row['nama']; ?></h5>
                                        <p class="card-text"><?=$row['keterangan']; ?>
                                        </p>
                                        <p class="card-text">Harga : Rp. <?=$row['harga']; ?><br>Stok :
                                            <?=$row['stok']; ?>
                                        </p>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">Setuju</button>&emsp;
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop2">Tidak</button>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins
                                                ago</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Setuju -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Menu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin menyetujui menu baru untuk dimasukkan kedalam Daftar Menu
                                        restoran
                                        Anda?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="setuju">Setuju</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Tidak Setuju -->
                        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Menu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin untuk membatalkan pengajuan menu baru?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" name="batal">Yakin</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </form>
            </table>
            <?php }else{
                echo "Belum ada pengajuan menu baru";
            };?>
        </div>
    </div>
</body>