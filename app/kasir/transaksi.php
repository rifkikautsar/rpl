    <title>Bayar</title>
    <style>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}
    </style>

    <body>
        <div class="container">
            <main>
                <div class="py-5 text-center">
                    <h2>Bayar</h2>
                </div>
                <div class="container-fluid d-flex flex-row pb-4" style="margin-left: 130px;">
                    <div class="p-2 bd-highlight">ID Pemesanan</div>
                    <div class="card text-center" style="width: 5rem; height: auto;">
                        <div class="card-header">
                            <?php
	                    include_once("../../functions.php");
                        $db = dbconnect();
                        if($db->connect_errno == 0 ){
                        if(isset($_GET["Id_pesanan"])){
                        $id_pesanan = $_GET["Id_pesanan"];
                        echo $id_pesanan;
                        ?>
                        </div>

                    </div>
            </main>
        </div>
        <div class="col d-flex justify-content-center pb-5  ">
            <table class="tableT table-bordered border-dark table-hover rounded">
                <thead class="tableT-green">
                    <?php
                        $sql =  "SELECT pemesanan.`id_pesanan`, menu.`id_menu`, menu.`nama`, rincian_pesanan.`jml_pesanan`, menu.`harga`, rincian_pesanan.`sub_total` FROM pemesanan
                            INNER JOIN rincian_pesanan ON  pemesanan.`id_pesanan` = rincian_pesanan.`id_pesanan`
                            INNER JOIN menu ON menu.`id_menu` = rincian_pesanan.`id_menu` where pemesanan.id_pesanan = '$id_pesanan'";
                            $res = $db->query($sql);
                    
                        if($res){
                ?>
                </thead>


                <!-- Isi table -->
                <tr>
                    <th>Id Pesanan</th>
                    <th>Id Menu</th>
                    <th>Nama Minuman</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>

                <?php
		            $data = $res->fetch_all(MYSQLI_ASSOC);
		            foreach($data as $dt){
                    $id_pesanan = $dt['id_pesanan'];
                ?>

                <tr>
                    <td><?php echo $dt["id_pesanan"]; ?></td>
                    <td><?php echo $dt["id_menu"]; ?></td>
                    <td><?php echo $dt["nama"]; ?></td>
                    <td><?php echo $dt["jml_pesanan"]; ?></td>
                    <td><?php echo $dt["harga"]; ?></td>
                    <td>Rp. <?php echo number_format($dt["sub_total"],0,",","."); ?></td>
                </tr>
                <?php
			
		    }
	?>
                <tfoot>
                    <tr>
                        <td colspan=4 style="text-align: center;">Sub Total Bayar</td>
                        <td colspan=2 style="text-align: center;">
                            <?php
                    $sql="SELECT SUM(sub_total) as total_bayar FROM rincian_pesanan WHERE id_pesanan='$id_pesanan'";
                    $result=$db->query($sql);
                    if($result){
                        $row=$result->fetch_assoc();
                    echo "Rp. ".number_format($row['total_bayar'],'0',',','.');
                    }
                    ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=4 style="text-align: center;">Pajak</td>
                        <td colspan=2 style="text-align: center;"><?php
                        $pajak = $row['total_bayar']*10/100;
                        echo "Rp. ".number_format($pajak,'0',',','.');
                        ?></td>
                    </tr>
                    <tr>
                        <td colspan=4 style="text-align: center;">Total Bayar</td>
                        <td colspan=2 style="text-align: center;"><?php
                        $total = $row['total_bayar']+$pajak;
                        echo "Rp. ".number_format($total,'0',',','.');
                        ?></td>
                    </tr>
                </tfoot>
                <?php
		        $res->free();
            }else
			        echo "Gagal Eksekusi SQL : "." : ".$db->error."<br>";
		    }

            }else
                    echo "Gagal Koneksi : "." : ".$db->connect_error."<br>";
	
	

		    ?>


            </table>
        </div>
        <div class="col d-flex justify-content-end ">
            <div class="container-fluid d-flex flex-row-reverse pb-4" style="margin-right: 200px;">
                <div class="card text-center" style="width: auto; height: auto;">
                    <div class="card-header">
                        Rp. 50.000,00
                    </div>
                </div>
                <div class="p-2 me-4 bd-highlight">Dibayar : </div>
            </div>
        </div>
        <div class="col d-flex justify-content-end ">
            <div class="container-fluid d-flex flex-row-reverse pb-4" style="margin-right: 200px;">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#transaksiModal">Bayar</button>
                <!-- Modal -->
                <div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Info Transaksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                Kembalian Anda Rp. 5.000,00
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>