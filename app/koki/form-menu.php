<title>Form Tambah Menu | Koki</title>

<body>
    <div class=" offset-lg-3 col-lg-6">
        <div class="container">
            <form class="col" action="" method="post" enctype="multipart/form-data">
                <div class="mb-3" col="12">
                    <label for="inputidmenu" class="form-label">ID Menu:</label>
                    <div class="input-group">
                        <!--<span class="input-group-text">M</span>-->
                        <input type="text" class="form-control form-control-sm" name="idmenu" autocomplete="off"
                            required>
                    </div>
                </div>
                <div class="mb-3" col="12">
                    <label for="inputNamaMenu" class="form-label">Nama Menu:</label>
                    <input type="text" class="form-control form-control-sm" name="nama-menu" autocomplete="off"
                        required>
                </div>
                <div class="mb-3" col="12">
                    <label for="inputHarga" class="form-label">Harga:</label>
                    <input type="number" class="form-control form-control-sm" name="harga-menu" autocomplete="off"
                        required>
                </div>
                <div class="mb-3" col="12">
                    <label for="inputStok" class="form-label">Stok</label>
                    <input type="number" class="form-control form-control-sm" name="stok" autocomplete="off" required>
                </div>
                <div class="mb-3" col="12">
                    <label for="inputKeterangan" class="form-label">Keterangan:</label>
                    <textarea class="form-control form-control-sm" rows="3" name="keterangan" autocomplete="off"
                        required></textarea>
                </div>
                <div class="mb-3" col="12">
                    <label for="inputKeterangan" class="form-label">Upload Foto Menu</label>
                    <input type="file" class="form-control" name="file" id="file" required />
                </div>
                <div class="mb-3" col="12">
                    <button class="btn btn-primary" type="submit" name="submit-menu">Submit</button>
                    <button class="btn btn-danger" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>

    <?php
include ("../../functions.php");

if (isset($_POST["submit-menu"])) {
    $db = dbConnect();

    if (validasiMenu($_POST) > 0) {
        echo "<script>
                alert('Pengajuan Menu Berhasil.');
                </script>";
                //echo header("Location: home-koki.php"); 
    }
    else
    echo mysqli_error($db);
    /*else {
        echo "<script>
        alert('Pengajuan Menu Gagal.');
        </script>";
    }*/
}
?>

</body>