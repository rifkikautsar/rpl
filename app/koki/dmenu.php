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
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>