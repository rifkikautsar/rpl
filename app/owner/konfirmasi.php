<title>Konfirmasi Menu Baru | Owner</title>
<style>
.main {
    height: 100% !important;
    min-height: 100vh;
}
</style>
<div class="container main">
    <div class="row justify-content-center">
        <?php
include_once ("../../functions.php");
$db=dbConnect();
$data = getMenuBaru();
if(!empty($data)){
?>
        <form action="" method="POST">
            <div class="card shadow mb-4">
                <div class="row row-cols-1 g-4 justify-content-center">
                    <?php foreach($data as $row):
                            $nama_file = $row['file'];?>
                    <input type="hidden" name="id_menu" value="<?=$row['id_menu']; ?>">
                    <div class="card mb-3" style="max-width: 768px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src=<?="../assets/images/$nama_file"?> class="img-fluid rounded-start" alt="..."
                                    style="width: 480px; height: 200px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <input type="hidden" name="id_menu" value="<?=$row['id_menu'];?>">
                                    <h5 class="card-title"><?=$row['nama'];?></h5>
                                    <p class="card-text"><?=$row['keterangan']; ?>
                                    </p>
                                    <p class="card-text">Harga : Rp. <?=$row['harga']; ?><br>Stok :
                                        <?=$row['stok']; ?>
                                    </p>
                                    <button type="button" class="btn btn-primary view-data1" data-bs-toggle="modal"
                                        id="<?=$row['id_menu'];?>">Setuju</button>&emsp;
                                    <button type="button" class="btn btn-danger view-data2" data-bs-toggle="modal"
                                        id="<?=$row['id_menu'];?>">Tidak</button>&emsp;
                                    <button type="button" class="btn btn-success view-data3" data-bs-toggle="modal"
                                        id="<?=$row['id_menu'];?>" name="id_menu">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Setuju -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Menu</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin menyetujui untuk dimasukkan kedalam Daftar
                                    Menu
                                    restoran
                                    Anda?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" name="setuju">Setuju</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Tidak Setuju -->
                    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
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
                                    <input type="text"><?=$row['id_menu']."-".$row['file'];?>
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
        <!-- Modal Ubah -->
        <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ubah Menu Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" id="insert_form">
                        <div class="modal-body detail">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Nama</td>
                                    <td><input type="text" name="nama" id="nama" value=""></td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td><input type="number" name="harga" id="harga" value=""></td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td><input type="number" name="stok" id="stok" value=""></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_menu" id="id_menu">
                            <button type="submit" class="btn btn-success" name="insert" id="insert"
                                value="Insert">Ubah</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </table>
        <?php }else{
                echo "Belum ada pengajuan menu baru";
            };?>
    </div>
</div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $(".view-data3").on("click", function() {
        var id_menu = $(this).attr("id");
        $.ajax({
            url: "getdetail.php",
            method: "post",
            dataType: "json",
            data: {
                id_menu: id_menu
            },
            success: function(data) {
                $("#nama").val(data.nama);
                $("#harga").val(data.harga);
                $("#stok").val(data.stok);
                $("#id_menu").val(data.id_menu);
                $("#staticBackdrop3").modal("show");
            }
        })
    });
});
$('#insert_form').on("submit", function(event) {
    event.preventDefault();
    if ($('#nama').val() == "") {
        alert("nama tidak boleh kosong");
    } else if ($('#harga').val() == '') {
        alert("harga tidak boleh kosong");
    } else if ($('#stok').val() == '') {
        alert("stok tidak boleh kosong");
    } else {
        $.ajax({
            url: "ubah.php",
            method: "POST",
            data: $('#insert_form').serialize(),
            beforeSend: function() {
                $('#insert').val("Inserting");
            },
            success: function(data) {
                Swal.fire({
                    title: 'Data berhasil diubah',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = "konfirmasi";
                    }
                })
            },
        });
    }
});
$(document).ready(function() {
    $(".view-data1").on("click", function() {
        var id_menu = $(this).attr("id");
        Swal.fire({
            title: 'Apakah anda setuju pembuatan menu baru?',
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Kembali',
            confirmButtonText: 'Setuju!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "insert.php",
                    method: "post",
                    data: {
                        id_menu: id_menu
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Tersimpan',
                            icon: 'success',
                            confirmButtonText: `Ok`
                        }).then((result) => {
                            document.location.href =
                                'konfirmasi'
                        })

                    }
                })
            }
        })
    });
});
$(document).ready(function() {
    $(".view-data2").on("click", function() {
        var id_menu = $(this).attr("id");
        Swal.fire({
            title: 'Apakah anda ingin membatalkan pengajuan menu baru?',
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Kembali',
            confirmButtonText: 'Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "delete.php",
                    method: "post",
                    data: {
                        id_menu: id_menu
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Tersimpan',
                            icon: 'success',
                            confirmButtonText: `Ok`
                        }).then((result) => {
                            document.location.href =
                                'konfirmasi'
                        })

                    }
                })
            }
        })
    });
});
</script>