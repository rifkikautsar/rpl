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
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>No Meja</th>
                    <th>Tanggal</th>
                    <th>Total Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tr>
                <td>T001</td>
                <td>Steven Udin</td>
                <td>01</td>
                <td>2021-06-01</td>
                <td>Rp. 38.500,00</td>
                <td><button type="button" class="btn btn-link">Bayar</button></td>
            </tr>
            <tr>
                <td>T002</td>
                <td>Johnson Knalpot</td>
                <td>02</td>
                <td>2021-07-02</td>
                <td>Rp. 30.500,00</td>
                <td><button type="button" class="btn btn-link">Bayar</button></td>
            </tr>
        </table>
    </div>
</body>