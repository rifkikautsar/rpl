<title>List Pesanan</title>
<style>
body {
    height: 100%;
}

.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}
</style>

<body>
    <h1 class="text-center py-2">List</h1>
    <div class="col d-flex justify-content-center pb-5  ">
        <table class="tableT table-bordered border-dark table-hover rounded">
            <thead class="tableT-green">
    <?php
	        include_once("../../functions.php");
	         $db = dbconnect();
	         if($db->connect_errno == 0 ){
		    $sql =  "SELECT pemesanan.id_pesanan, pelanggan.nama, meja.no_meja, pemesanan.tgl_pesan, pembayaran.total_bayar FROM pemesanan
                     INNER JOIN pembayaran ON pemesanan.id_pesanan = pembayaran.id_pesanan
                    INNER JOIN pelanggan ON pemesanan.id_pelanggan = pelanggan.id_pelanggan
                     INNER JOIN meja ON pelanggan.no_meja = meja.no_meja";
		    $res = $db->query($sql);
		    if($res){
    ?>

    <table border=1>
		<tr>
			    <th>Id Pesanan</th>
			    <th>Nama Pelanggan</th>
			    <th>No Meja</th>
			    <th>Tanggal</th>
			    <th>Total Bayar</th>
			    <th>Aksi</th>
		</tr>

        <?php
		        $data = $res->fetch_all(MYSQLI_ASSOC);
		        foreach($data as $dt){	
	    ?>

             <tr>
				<td><?php echo $dt["id_pesanan"]; ?></td>
				<td><?php echo $dt["nama"]; ?></td>
				<td><?php echo $dt["no_meja"]; ?></td>
				<td><?php echo $dt["tgl_pesan"]; ?></td>
				<td>Rp. <?php echo number_format($dt["total_bayar"],0,",","."); ?></td>
				<td><a href ="transaksi.php?Id_pesanan=<?php echo $dt["id_pesanan"] ?>">Bayar </a>			
			</tr>
		<?php
	}
?>


            </thead>
	<?php
		$res->free();
	}else
			echo "Gagal Eksekusi SQL : "." : ".$db->error."<br>";
	}else
			echo "Gagal Koneksi : "." : ".$db->connect_error."<br>";
		?>


        </table>
    </div>
</body>