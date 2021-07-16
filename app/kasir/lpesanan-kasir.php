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
    		?>
                <tr>
                    <th>Id Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>No Meja</th>
                    <th>Tanggal</th>
                    <th>Sub Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
		        $data = getDaftarPesanan();
		        foreach($data as $dt){
				$id_pesanan = $dt['id_pesanan'];	
				?>
            <tr>
                <td><?php echo $dt["id_pesanan"]; ?></td>
                <td><?php echo $dt["nama"]; ?></td>
                <td><?php echo $dt["no_meja"]; ?></td>
                <td><?php echo $dt["tgl_pesan"]; ?></td>
                <td>
                    <?php
					$sql="SELECT SUM(sub_total) as total_bayar FROM rincian_pesanan WHERE id_pesanan='$id_pesanan'";
					$res=$db->query($sql);
					if($res){
						$row=$res->fetch_assoc();
					echo "Rp. ".number_format($row['total_bayar'],'0',',','.');
					}
					$res->free();
					?>
                </td>
                <td><a href="index.php?page=transaksi&&Id_pesanan=<?php echo $dt["id_pesanan"] ?>">Bayar </a>
            </tr>
            <?php
						}
						}else
								echo "Gagal Koneksi : "." : ".$db->connect_error."<br>";
						?>
        </table>
    </div>
</body>