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
		$sql = "SELECT menu.id_menu from menu join rincian_pesanan rp using(id_menu)
		where rp.id_pesanan = '$id_pesanan'";
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
		$sql= "SELECT kd_meja from meja where meja.status='kosong'";
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
// function getPelanggan($nama,$meja){
// 	$db=dbConnect();
// 	if($db->connect_errno==0){
// 		$sql= "SELECT id_pelanggan from pelanggan 
// 		where nama='$nama' and meja='$meja'";
// 		$res=$db->query($sql);
// 		if($res){
// 			$data=$res->fetch_all(MYSQLI_ASSOC);
// 			$res->free();
// 			return $data;
// 		}
// 		else
// 			return FALSE; 
// 	}
// 	else
// 		return FALSE;
// }
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
?>