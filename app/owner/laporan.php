<title>Laporan Keuangan</title>
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
    <div class="home">
        <h1 class="text-center py-2">Laporan Keuangan</h1>
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
            </div>
            <div class="col d-flex justify-content-center pb-5  ">
                <table class="table table-striped table-hover rounded" style="min-width: 700px; max-width: 50%;">
                    <thead>
                        <tr>
                            <th>Minggu 1</th>
                            <th>Minggu 2</th>
                            <th>Minggu 3</th>
                            <th>Minggu 4</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                    </tr>
                    <tr>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
</body>
<script>
$(document).ready(function() {
    $("#bulan").on("change", function() {
        alert($("#bulan").val());
    })
});
</script>