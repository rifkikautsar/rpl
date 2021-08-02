<title>Daftar Menu | Koki</title>
<?php
include_once("../../functions.php");
$db=dbConnect();
if($db->connect_errno==0){
    if(isset($_POST['hapus'])){
        $id_menu = $_POST['id_menu'];
        $sql = "SELECT menu.file from menu where id_menu='$id_menu'";
        $res=$db->query($sql);
        $data = $res->fetch_assoc();
        $file = $data['file'];
        if(file_exists($_SERVER["DOCUMENT_ROOT"]."/data/rpl/app/assets/images/$file")){
            unlink($_SERVER["DOCUMENT_ROOT"]."/data/rpl/app/assets/images/$file");
            $sql = "DELETE from menu where id_menu = '$id_menu'";
            $res=$db->query($sql);
            if($res){
                echo "
                <script>
                alert('Menu berhasil dihapus');
                document.location.href = 'menu';
                </script>";
            }else{
                echo "
                <script>
                alert('Menu GAGAL dihapus');
                </script>";
            }
        }else{
            $sql = "DELETE from menu where id_menu = '$id_menu'";
            $res=$db->query($sql);
            if($res){
                echo "
                <script>
                alert('Menu berhasil dihapus');
                document.location.href = 'menu';
                </script>";
            }else{
                echo "
                <script>
                alert('Menu gagal dihapus');
                </script>";
            }
        }
    };
?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Menu Minuman</h6>
                    </div>
                    <!-- Card Body -->

                    <div class="card-body" style="height: 450px; overflow: scroll;">
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <?php $k = getMenuKoki(); foreach($k as $row) :
                                $nama_file =$row['file']; ?>

                            <div class="col">
                                <div class="card">
                                    <img src=<?="../assets/images/$nama_file"?> style="width: 480; height: 200px;"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row['nama'];?> </h5>
                                        <p class="card-text"><?= $row['keterangan'];?>
                                        </p>
                                        <p class="card-text">Harga Rp. <?=$row['harga'];?></p>
                                        <p class="card-text">Stok <?=$row['stok'];?></p>
                                        <form action="" method="post">
                                            <input type="hidden" name="id_menu" id="" value="<?=$row['id_menu'];?>">
                                            <button type="button" class="btn btn-primary view-data"
                                                id="<?=$row['id_menu'];?>">Edit</button>
                                            <button type="submit" class="btn btn-danger hapus"
                                                id="<?=$row['id_menu'];?>" name="hapus">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Modal Ubah -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Menu</h5>
                                </div>
                                <form action="" method="POST" id="insert_form" enctype="multipart/form-data">
                                    <div class="modal-body detail">
                                        <table class="table table-borderless">
                                            <input type="hidden" name="id_menu" id="id_menu">
                                            <tr>
                                                <td>Gambar</td>
                                                <td><img src="" alt="" id="image" style="width: 200px; height: 150px;"
                                                        class="card-img-top"> </td>
                                            </tr>
                                            <tr>
                                                <td>Nama Menu</td>
                                                <td><input type="text" name="nama" id="nama" value=""></td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td><textarea id="keterangan" name="keterangan" value=""></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Harga</td>
                                                <td><input type="number" name="harga" id="harga" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Stok</td>
                                                <td><input type="number" id="stok" name="stok"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success ubah-data" name="insert"
                                            id="insert" value="Insert">Ubah</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Menunggu Persetujuan</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-1 g-4">
                            <?php include_once("../../functions.php");
                            $db=dbConnect();
                            ?>
                            <?php $k = getPengajuanMenu();
                            if(!empty($k)){
                            foreach($k as $row) {
                                $nama_file =$row['file']; ?>
                            <div class="col">
                                <div class="card">
                                    <img src=<?="../assets/images/$nama_file"?> style="width: 480; height: 200px;"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row['nama'];?> </h5>
                                        <p class="card-text"><?= $row['keterangan'];?>
                                        </p>
                                        <p class="card-text">Harga Rp. <?=$row['harga'];?></p>
                                        <p class="card-text">Stok <?=$row['stok'];?></p>
                                        <p class="card-text">Status : <?=$row['status'];?></p>
                                    </div>
                                </div>
                            </div>
                            <?php }
                                }else{
                                    echo "Tidak ada pengajuan menu baru";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php 
}
?>
<script>
// $(document).ready(function() {
//     $(".view-data").on("click", function() {
//         var id_menu = $(this).attr("id");
//         $.ajax({
//             url: "getdetail.php",
//             method: "post",
//             dataType: "json",
//             data: {
//                 id_menu: id_menu
//             },
//             success: function(data) {
//                 $("#nama").val(data.nama);
//                 $("#harga").val(data.harga);
//                 $("#stok").val(data.stok);
//                 $("#id_menu").val(data.id_menu);
//                 $("#staticBackdrop3").modal("show");
//             }
//         })
//     });
// });
// $('#insert_form').on("submit", function(event) {
//     event.preventDefault();
//     if ($('#nama').val() == "") {
//         alert("nama tidak boleh kosong");
//     } else if ($('#harga').val() == '') {
//         alert("harga tidak boleh kosong");
//     } else if ($('#stok').val() == '') {
//         alert("stok tidak boleh kosong");
//     } else {
//         $.ajax({
//             url: "ubah.php",
//             method: "POST",
//             data: $('#insert_form').serialize(),
//             beforeSend: function() {
//                 $('#insert').val("Inserting");
//             },
//             success: function(data) {
//                 Swal.fire({
//                     title: 'Data berhasil diubah',
//                     icon: 'success',
//                     confirmButtonColor: '#3085d6',
//                     cancelButtonColor: '#d33',
//                     confirmButtonText: 'Ok!'
//                 }).then((result) => {
//                     if (result.isConfirmed) {
//                         document.location.href = "menu";
//                     }
//                 })
//             },
//         });
//     }
// });
$(document).ready(function() {
    $(".view-data").on("click", function() {
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
                $("#keterangan").val(data.keterangan);
                $("#harga").val(data.harga);
                $("#stok").val(data.stok);
                $("#image").attr("src", '../assets/images/' + data.file);
                $("#id_menu").val(data.id_menu);
                $("#staticBackdrop").modal("show");
            }
        })
    });
});
$(".ubah-data").on('click', function() {
    var form = $("#insert_form");
    $("#insert_form").submit(function(event) {
        event.preventDefault();
        if ($('#nama').val() == "") {
            alert("Nama tidak boleh kosong");
        } else if ($('#keterangan').val() == '') {
            alert("Keterangan tidak boleh kosong");
        } else if ($('#harga').val() == '') {
            alert("Harga tidak boleh kosong");
        } else if ($('#stok').val() == '') {
            alert("Stok tidak boleh kosong");
        } else {
            $.ajax({
                url: "ubah-menu.php",
                method: "post",
                data: $('#insert_form').serialize(),
                success: function(data) {
                    if (data == "OK") {
                        Swal.fire({
                            title: 'Data berhasil diubah',
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = "menu";
                            }
                        });
                    } else if (data == "ERROR") {
                        Swal.fire({
                            title: 'Data gagal diubah',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.href = "menu";
                            }
                        })
                    }
                },
                error: function(data) {
                    alert('error');
                }
            })
        }
    })
})
</script>