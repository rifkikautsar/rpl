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
                            T001
                        </div>

                    </div>
            </main>
        </div>
        <div class="col d-flex justify-content-center pb-5  ">
            <table class="tableT table-bordered border-dark table-hover rounded">
                <thead class="tableT-green">
                    <tr>
                        <th>ID Menu</th>
                        <th>Nama Minuman</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>


                <!-- Isi table -->
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
                <tfoot>
                    <td colspan=4 style="text-align: center;">Pajak</td>
                    <td>Rp.3500</td>
                    </td>
                    </td>
                </tfoot>
                <tfoot>
                    <td colspan=4 style="text-align: center;">Total Bayar</td>
                    <td>Rp.3500</td>
                    </td>
                    </td>
                </tfoot>
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