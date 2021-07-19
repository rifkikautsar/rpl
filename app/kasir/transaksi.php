    <title>Pembayaran | Kasir</title>
    <style>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}
    </style>
    <?php
    if(!isset($_GET['Id_pesanan']) || isset($_GET['Id_pesanan'])==""){
        ?>

    <body>
        <div class="container h-75">
            <div class="row">
                <div class="col text-center" style="top: 150px;">
                    <h3>Tidak ada Pesanan yang dipilih!</h3>
                    <p>Pilih Pesanan di menu List Pesanan</p>
                </div>
            </div>
        </div>
    </body>
    <?php
    }else{
        include_once("../../functions.php");
        $db = dbconnect();
        if($db->connect_errno == 0 ){
        function getName($n) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            $randomString = '';
        
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
        
            return $randomString;
        };
        if(isset($_POST['submit'])){
            $id_pesanan = $_POST['id_pesanan'];
            $total = $_POST['total'];
            $id_pembayaran = getName(10);
        $db1= new PDO('mysql:host=localhost; dbname=rpl', 'root', '');
        $db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        try {
            $db1->beginTransaction();
            $sh = $db1->prepare("UPDATE pemesanan SET pemesanan.status=?, pemesanan.ket=? where id_pesanan=?");
            $sh->execute(['bayar','selesai',$id_pesanan]);
            $sh = $db1->prepare("INSERT into pembayaran values(?,?,?,?,?)");
            $sh->execute([$id_pembayaran,$id_pesanan,'PP001',$total,'cash']);
            $db1->commit();
            echo "
            <script>
            alert('Pembayaran berhasil ditambahkan');
            document.location.href = 'index.php';
            </script>";
        } catch ( Exception $e ) {
            $db1->rollBack();
            echo "
            <script>
            alert('Pembayaran gagal');
            </script>";
        }
        }
        ?>

    <body>
        <form action="" method="post">
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
                        <input type="hidden" name="id_pesanan" value="<?=$dt["id_pesanan"];?>">
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
                            <input type="hidden" name="total" id="total" value="<?=$total?>">
                        </tr>
                    </tfoot>
                    <?php
		        $res->free();
            }else
			        echo "Gagal Eksekusi SQL : "." : ".$db->error."<br>";
		    }
            
		    ?>
                </table>
            </div>
            <div class="col d-flex justify-content-end ">
                <div class="container-fluid d-flex flex-row-reverse pb-4" style="margin-right: 200px;">
                    <div class="card text-center" style="width: auto; height: auto;">
                        <div class="card-header">
                            <input type="number" name="pembayaran" id="pembayaran" placeholder="Jumlah uang">
                        </div>
                    </div>
                    <div class="p-2 me-4 bd-highlight">Dibayar : </div>
                </div>
            </div>
            <div class="col d-flex justify-content-end ">
                <div class="container-fluid d-flex flex-row-reverse pb-4" style="margin-right: 200px;">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-success bayar" data-bs-toggle="modal">Bayar</button>
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
                                <div class="modal-body text-center isi">
                                    Masukkan uang pembayaran terlebih dahulu ya
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal" name="submit"
                                        id="submit">Bayar</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" name="oke"
                                        id="oke">Kembali</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </body>
    <?php
            }else
            echo "Gagal Koneksi : "." : ".$db->connect_error."<br>";
    }
?>
    <script>
$(document).ready(function() {
    var tbayar = $("#total").val();
    $(".bayar").on('click', function() {
        if ($("#pembayaran").val() == "") {
            $(".isi").html("Masukkan uang pembayaran terlebih dahulu ya");
            $("#submit").hide();
            $("#transaksiModal").modal("show");
        } else if (parseFloat($("#pembayaran").val()) < parseFloat(tbayar)) {
            $(".isi").html("Jumlah uang pembayaran tidak valid!");
            $("#submit").hide();
            $("#transaksiModal").modal("show");
        } else {
            var uang = $("#pembayaran").val();
            var kembalian = parseFloat(uang) - parseFloat(tbayar);
            $(".isi").html("Kembalian Anda : Rp. " + kembalian);
            $("#submit").show();
            $("#transaksiModal").modal("show");
        }
    })
})
    </script>