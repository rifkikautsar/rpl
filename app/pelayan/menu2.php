<title>Daftar Menu</title>

<?php
error_reporting(0);
include_once($_SERVER['DOCUMENT_ROOT']."/data/rpl/functions.php");
$db=dbConnect();
if(isset($_REQUEST['tambah_pesan'])){
    $str = $_REQUEST['tambah_pesan'];
    $id_menu = substr($str,0,3);
    $hrg = substr($str,4);
    $id_pelanggan = $_POST['id_pel'];
    $id_pesanan = $_POST['id_pesanan'];
    $nama_pel = $_POST['nama_pelanggan'];
    $id_pel = $_POST['id_pel'];
   
    $sql_tb_pesanan = "insert into pemesanan(id_pesanan,id_pelanggan) values('$id_pesanan','$id_pel')";
    $res=$db->query($sql_tb_pesanan);
    $sql_tb_rincian = "insert into rincian_pesanan(id_menu,id_pesanan) 
                      values ('$id_menu','$id_pesanan')";
    $res2=$db->query($sql_tb_rincian);
}
if(isset($_REQUEST['hapus_pesan'])){
    $str = $_POST['hapus_pesan'];
    $id_menu = substr($str,0,3);
    $id_pesanan = substr($str,4);
    $sql_hapus = "delete from rincian_pesanan where id_menu='$id_menu' and id_pesanan ='$id_pesanan'" ;
    $res=$db->query($sql_hapus);
}
if(isset($_REQUEST['checkout'])){
    $jumlah = $_REQUEST['jumlah'];
    $menu = $_REQUEST['nama_menu'];
    $id = $_REQUEST['id_menu'];
    $id_psn = $_REQUEST['id_pesanan'];
    $meja = $_REQUEST['kd_meja'];
    $id_pelanggan = $_REQUEST['id_pel'];
    
    //update meja
    $res=$db->query("UPDATE pelanggan SET no_meja='$meja' where id_pelanggan = '$id_pelanggan'");
    $res=$db->query("UPDATE pemesanan SET no_meja='$meja' where id_pelanggan = '$id_pelanggan'");
    // $kd_meja = $_REQUEST['kd_meja'];
    // //update meja
    // $sql_meja = "UPDATE meja SET meja.status='isi' where kd_meja ='$kd_meja'";
    // $res=$db->query($sql_meja);

    //update stok
    for($i=0; $i<count($id);$i++){
        $array[]=array("id_menu"=>$id[$i],
                       "nama"=>$menu[$i],
                       "id_pesanan"=>$id_psn,
                       "harga"=>$harga[$i],
                       "jumlah"=>$jumlah[$i]);
    }
    for($i=0;$i<count($array);$i++){
        $id_menu = $array[$i]['id_menu'];
        $jml_menu = $array[$i]['jumlah'];
        $id_psn = $array[$i]['id_pesanan'];
        $sql = "UPDATE menu SET stok=stok-'$jml_menu'
        WHERE id_menu = '$id_menu'";
        $res=$db->query($sql);
    }
    
    echo "
    <script>
    alert('Pesanan berhasil dibuat');
    document.location.href = 'index.php';
    </script>";
}
if(isset($_REQUEST['simpan'])){
    $jumlah = $_REQUEST['jumlah'];
    $menu = $_REQUEST['nama_menu'];
    $id = $_REQUEST['id_menu'];
    $id_psn = $_REQUEST['id_pesanan'];
    $harga = $_REQUEST['harga'];
   
    //array pesanan
    for($i=0; $i<count($id);$i++){
        $array[]=array("id_menu"=>$id[$i],
                       "nama"=>$menu[$i],
                       "id_pesanan"=>$id_psn,
                       "harga"=>$harga[$i],
                       "jumlah"=>$jumlah[$i]);
    }
    for($i=0;$i<count($array);$i++){
        $id_menu = $array[$i]['id_menu'];
        $nama_menu = $array[$i]['nama'];
        $jml_menu = $array[$i]['jumlah'];
        $id_psn = $array[$i]['id_pesanan'];
        $harga = $array[$i]['harga'];
        $sql = "UPDATE rincian_pesanan SET jml_pesanan='$jml_menu', sub_total = '$harga'*'$jml_menu'
        WHERE id_menu = '$id_menu' and id_pesanan = '$id_psn'";
        $res=$db->query($sql);
    }
}
if(isset($_POST['batal'])){
    $id_pelanggan = $_POST['id_pel'];
    $sql = "DELETE from pelanggan where id_pelanggan = '$id_pelanggan'";
    $res = $db->query($sql);
    if($res){
        echo "
        <script>
        alert('Pesanan dibatalkan');
        document.location.href = 'testing.php';
        </script>";
    }
}
?>

<body>
    <div class="container">
        <form method="post" name="f">
            <div class="row">
                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Menu Minuman</h6>
                            <!-- <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div> -->
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table table-borderless table-responsive-md">
                                <tr>
                                    <td>No Meja</td>
                                    <td><select name="kd_meja" id="kd_meja" onchange="show()">
                                            <option
                                                value="<?php echo(isset($_POST['kd_meja'])?$_POST['kd_meja']:"");?>">
                                                <?php echo(isset($_POST['kd_meja'])?$_POST['kd_meja']:"Pilih Meja");?>
                                            </option>
                                            <?php
                                        $m = getListMeja();
                                        foreach($m as $row){
                                            ?>
                                            <option value="<?=$row['no_meja']?>"><?=$row['no_meja']?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td><input type="text" name="nama_pelanggan" id="nama_pelanggan" onblur="ceknama()"
                                            autocomplete="off" value="<?php
                                            echo(isset($_POST['nama_pelanggan'])?$_POST['nama_pelanggan']:"");
                                            ?>"></td>
                                </tr>
                                <tr>
                                    <td>ID Pesanan</td>
                                    <td><input type="text" name="id_pesanan" id="id_pesanan" size="5" readonly value="<?php
                                    if(isset($_POST['id_pesanan'])){
                                    $id_pesanan = $_POST['id_pesanan'];
                                        if(empty($id_pesanan)){
                                            $sql_get_id = "SELECT max(id_pesanan) as id_pesanan FROM pemesanan";
                                            $res=$db->query($sql_get_id);
                                            $data=$res->fetch_assoc();
                                            if(empty($data)){
                                                $id_pesanan=1;
                                            }else{
                                            $angka = (int)$data['id_pesanan']+1;
                                            $id_pesanan = $angka;
                                            }
                                            echo $id_pesanan;
                                        }else echo $id_pesanan;
                                };
                                            ?>"></td>
                                </tr>
                                <tr>
                                    <td>ID Pel</td>
                                    <td><input type="text" name="id_pel" id="id_pel" size="5" readonly value="<?php
                                if(isset($_POST['id_pel'])){
                                    $id_pel = $_POST['id_pel'];
                                    $meja = $_REQUEST['kd_meja'];
                                    $nama = $_REQUEST['nama_pelanggan'];
                                        if(empty($id_pel)){
                                        $sql_get_pel = "SELECT max(id_pelanggan) as id_pelanggan FROM pelanggan";
                                        $res=$db->query($sql_get_pel);
                                        $data=$res->fetch_assoc();
                                        if(empty($data)){
                                            $id_pel=1;
                                        }else{
                                        $angka = (int)$data['id_pelanggan'];
                                        $id_pel = $angka+1;
                                        }
                                        $sql_tb_pelanggan = "insert into pelanggan(id_pelanggan,nama) values('$id_pel','$nama')";
                                        $res=$db->query($sql_tb_pelanggan);
                                        echo $id_pel;
                                        }else echo $id_pel;
                                }else echo "";
                                ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><button name="ok" value="ok" class="btn btn-success"
                                            style="width: 5em;">Ok</button>
                                    </td>
                                    <?php if(isset($_POST['id_pel'])) : ?>
                                    <td><button name="batal" value="batal" class="btn btn-danger"
                                            style="width: 8em; ">Batal</button></td>
                                    <?php endif; ?>
                                </tr>
                            </table>
                            <?php
                        $k = getMenu();
                        ?>
                            <div class="row row-cols-1 row-cols-md-4 g-4">
                                <?php foreach($k as $row) : ?>
                                <div class="col">
                                    <div class="card">
                                        <img src="../assets/images/M01.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $row['nama'];?> </h5>
                                            <p class="card-text"><?= $row['keterangan'];?>
                                            </p>
                                            <p class="card-text">Harga Rp. <?=$row['harga'];?></p>
                                            <p class="card-text">Stok <?=$row['stok'];?></p>
                                        </div>
                                        <?php $dt = getIDMenu($_POST['id_pesanan']);?>
                                        <?php if(in_array($row['id_menu'],array_column($dt,'id_menu'))){ ?>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger">
                                                <i class='uil uil-shopping-basket'></i>&nbsp;Dipesan&nbsp;
                                            </button>
                                        </div>
                                        <?php } else { ?>
                                        <div class="card-footer">
                                            <button type="submit" value="<?=$row['id_menu']."-".$row['harga']?>"
                                                name="tambah_pesan" id="<?=$row['id_menu']?>" class="btn btn-success">
                                                <i class='uil uil-shopping-basket'></i>&nbsp;Tambah&nbsp;
                                            </button>
                                        </div>
                                        <?php }; ?>

                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Keranjang Pemesanan</h6>
                            <!-- <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div> -->
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <table class="table table-bordered table-responsive-md">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50%">Menu Pesanan</th>
                                        <th style="width: 30%">Jumlah</th>
                                        <th style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                
                                $list = getPesanan($_POST['id_pesanan']);
                                foreach($list as $pesanan) :
                                ?>
                                    <tr>
                                        <input type="hidden" name="nama_menu[]" value="<?=$pesanan['nama'];?>">
                                        <input type="hidden" name="id_menu[]" value="<?=$pesanan['id_menu'];?>">
                                        <th><span id="nama_menu"><?=$pesanan['nama'];?></span>
                                        </th>
                                        <th>
                                            <input id="harga" name="harga[]" class="span8" type="hidden"
                                                value="<?=$pesanan['harga'];?>">
                                            <center>
                                                <input type="number" value="<?=$pesanan['jml_pesanan'];?>"
                                                    style="width: 5em" id="jumlah" name="jumlah[]">
                                            </center>
                                        </th>
                                        <td>
                                            <button type="submit" name="hapus_pesan"
                                                value="<?=$pesanan['id_menu']."-".$pesanan['id_pesanan'];?>"
                                                class="btn btn-danger btn-mini">
                                                <i class='uil uil-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php if($list) : ?>
                                    <tr>
                                        <td colspan="3"><button type="submit" name="simpan" value=""
                                                class="btn btn-success btn-mini">Simpan</button>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">
                                                Checkout
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Pesanan Anda</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-borderless">
                                                <?php
                                            if(isset($_POST['simpan'])){
                                            $total = 0;
                                            $list = getPesanan($_POST['id_pesanan']);
                                            foreach($list as $pesanan) :
                                            $total += $pesanan['sub_total'];
                                            ?>
                                                <tr>
                                                    <td><?=$pesanan['id_menu'];?></td>
                                                    <td><?=$pesanan['nama'];?></td>
                                                    <td><?=$pesanan['harga'];?></td>
                                                    <td><?=$pesanan['jml_pesanan'];?></td>
                                                    <td><?=$pesanan['sub_total'];?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="3" align="center">
                                                        Total Bayar :
                                                    </td>
                                                    <td colspan="2" align="center"
                                                        class="font-weight-bold text-primary">Rp.
                                                        <?=number_format($total,2,",",".");?></td>
                                                </tr>
                                                <?php }else{ ?>
                                                Yah belum ada pesanan. Pesan dulu ya dan masukkan jumlah pesanan, lalu
                                                klik
                                                simpan!
                                                <?php } ?>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <?php if(isset($_POST['simpan'])) : ?>
                                            <button type="submit" class="btn btn-primary"
                                                name="checkout">Checkout</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <?php else : ?>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>