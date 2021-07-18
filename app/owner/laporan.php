<title>Laporan Keuangan | Owner</title>
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
<?php
include_once("../../functions.php");
$db=dbConnect();
if($db->connect_errno==0){
?>

<body>
    <div class="h-100">
        <h1 class="text-center py-2">Laporan Keuangan</h1>
        <h3 class="text-center">Restoran iCendol</h3>
        <main>
            <div class="container-fluid d-flex pb-4" style="margin-left: auto;">
                <div class="p-2 bd-highlight">Bulan</div>
                <select class="form-select form-select-sm" id="bulan" aria-label=".form-select-sm example"
                    style="width: 200px;">
                    <option selected>Pilih Bulan</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
                <div class="p-2 bd-highlight">Tahun</div>
                <select name='tahun' class="form-select form-select-sm" id="tahun" aria-label=".form-select-sm example"
                    style="width: 100px;">
                    <?php
                    $qry=mysqli_query($db, "SELECT tgl_pesan FROM pemesanan GROUP BY year(tgl_pesan)");
                    while($t=mysqli_Fetch_array($qry)){
                    $data = explode('-',$t['tgl_pesan']);
                    $tahun = $data[0];
                    echo "<option value='$tahun'>$tahun</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col d-flex justify-content-center pb-5 detail">
            </div>
        </main>
    </div>
</body>
<?php } ?>
<script>
$(document).ready(function() {
    $("#bulan").on("change", function() {
        var bulan = $("#bulan").val();
        var tahun = $("#tahun").val();
        $.ajax({
            url: "getlaporan.php",
            method: "post",
            data: {
                bulan: bulan,
                tahun: tahun
            },
            success: function(data) {
                $(".detail").html(data);
            }
        });
    });
});
</script>