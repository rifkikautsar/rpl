<?php
function dbConnect(){
	global $db;
	$db=new mysqli("localhost","root","","rpl");
	return $db;
}
function getMenu(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql = "select * from menu where stok > 0 and status = 'disajikan' order by id_menu";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getPesanan($id_pesanan){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql = "SELECT rp.id_menu,rp.id_pesanan,rp.jml_pesanan,rp.sub_total,m.nama,m.harga from rincian_pesanan rp
                            JOIN menu m ON rp.id_menu=m.id_menu where rp.id_pesanan='$id_pesanan'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getIDMenu($id_pesanan){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql = "SELECT id_menu from rincian_pesanan where id_pesanan = '$id_pesanan'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getListMeja(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT no_meja from meja where meja.status='kosong'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getIdPel($nama,$meja){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT id_pelanggan from pelanggan where
		nama = '$nama' and no_meja='$meja'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getHarga(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT harga from menu";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getDaftarPesanan(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pesanan,p.no_meja,p.tgl_pesan,p.ket, pel.nama,pel.id_pelanggan from pemesanan p join pelanggan pel using(id_pelanggan) where p.status = 'belum' order by p.id_pesanan ASC";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getRincianPesanan($id_pesanan){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT menu.nama as nama_menu, menu.harga,rp.id_pesanan, rp.jml_pesanan, rp.sub_total from rincian_pesanan rp join menu using(id_menu) where rp.id_pesanan = '$id_pesanan'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function showError($message){
	?>
<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
        class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </svg>
    <div>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?=$message;?>
    </div>
</div>
<?php
}

function validasiMenu($data) {
	$db=dbConnect();

	$id_menu = $db->escape_string($_POST["idmenu"]);
    $nama = $db->escape_string($_POST["nama-menu"]);
    $harga = $db->escape_string($_POST["harga-menu"]);
    $stok = $db->escape_string($_POST["stok"]);
	$keterangan = $db->escape_string($_POST['keterangan']); 

	//validasi ID Menu
    $sql = "select id_menu from menu where id_menu = '$id_menu'";
    $res = $db->query($sql);
    $menudata = $res->fetch_all(MYSQLI_ASSOC);

    foreach ($menudata as $menudata) {

        if ($menudata) {
            echo "<script>
            alert('ID Menu yang dimasukkan sudah tersedia');
            </script>";
            return false; 
        } 
    }

	//validasi Nama Menu
    $sql = "select nama from menu where nama = '$nama'";
    $res = $db->query($sql);
    $menudata = $res->fetch_all(MYSQLI_ASSOC);
    foreach ($menudata as $menudata) {
        if ($menudata) {
            echo "<script>
            alert('Nama Menu yang dimasukkan sudah tersedia');
            </script>";
            return false; 
        } 
    }
	$namaFile = $_FILES['file']['name'];
	$x = explode('.', $namaFile);
	$ekstensi = strtolower(end($x));
	$ekstensiYangDibolehkan = [
		'image/png',
		'image/jpg',
		'image/jpeg',
		'image/webp'
	];
	$ukuranFile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpName = $_FILES['file']['tmp_name'];
	if (!in_array(mime_content_type($tmpName), $ekstensiYangDibolehkan)) {
		echo "
		<script>
		alert('File tidak sesuai!');
		document.location.href = 'form';
		</script>";
    }else if($ukuranFile > 1000 * 10000){
		echo "
		<script>
		alert('File terlalu besar!');
		document.location.href = 'form';
		</script>";
	}
	else {
	$file = $id_menu.".".$ekstensi;
    move_uploaded_file($tmpName,$_SERVER["DOCUMENT_ROOT"]."/data/rpl/app/assets/images/".$file);
	//Masukkan data menu ke database
	$db->query("insert into menu VALUES ('$id_menu','$nama','$harga','$stok','$keterangan','ditunda','$file')");
	}
	return mysqli_affected_rows($db);
}
function getMenuBaru(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql="SELECT * from menu where menu.status='ditunda'";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
function getDaftarPesananKoki(){
	$db=dbConnect();
	if($db->connect_errno==0){
		$sql= "SELECT p.id_pesanan,p.no_meja,p.tgl_pesan,p.ket, pel.nama,pel.id_pelanggan from pemesanan p join pelanggan pel using(id_pelanggan) where p.status = 'belum' and p.ket='proses' order by p.id_pesanan ASC";
		$res=$db->query($sql);
		if($res){
			$data=$res->fetch_all(MYSQLI_ASSOC);
			$res->free();
			return $data;
		}
		else
			return FALSE; 
	}
	else
		return FALSE;
}
?>