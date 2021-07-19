<title>Daftar Menu | Koki</title>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Menu Minuman</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            <?php include_once("../../functions.php");
                            $db=dbConnect();
                            ?>
                            <?php $k = getMenu(); foreach($k as $row) :
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
                                        <button class="btn btn-danger view-data" id="<?=$row['id_menu'];?>">Ubah
                                            Stok</button>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- Modal Ubah -->
                    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Ubah Menu Baru</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" method="post" id="insert_form">
                                    <div class="modal-body detail">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>Nama</td>
                                                <td><input type="text" name="nama" id="nama" value="" readonly></td>
                                            </tr>
                                            <tr>
                                                <td>Harga</td>
                                                <td><input type="number" name="harga" id="harga" value="" readonly></td>
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
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Kembali</button>
                                    </div>
                                </form>
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
                        document.location.href = "menu";
                    }
                })
            },
        });
    }
});
</script>