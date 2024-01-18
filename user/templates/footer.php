<div class="modal fade" id="masuk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="float-right mr-2">&times;</span>
            </button>
            <h4 class="modal-title text-center">MASUK</h4>
            <div class="modal-body">
                <form class="w-75 py-4 m-auto" action="" method="POST">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" id="Email" name="email">
                    </div>
                    <div class="form-group ">
                        <label for="password">Kata Sandi</label>
                        <input type="password" class="form-control border-right-0" id="password" name="sandi" autocomplete="off">
<!-- 
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-left-0" id="btn-pwd" style="cursor: pointer"><i id="eye" class="fa fa-eye"></i></span>
                            </div>
                        </div> -->
                    </div>
                    <div class="text-center">
                        <button name="masuk" type="submit" class="btn btn-primary w-100">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pembayaran -->

<?php if (isset($transaksi)) : ?>
    <?php foreach ($transaksi as $key => $trans) : ?>
        <div class="modal fade" id="bayar<?= $trans->id_pesan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>ID Pesan : <?= $trans->id_pesan ?> | Penerima : <?= $trans->penerima ?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="idpesan" value="<?= $trans->id_pesan ?>">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input class="form-control" type="text" name="nama" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input class="form-control" type="number" name="nominal" id="nominal" value="<?= $trans->total_akhir + $trans->ongkir ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Unggah bukti pembayaran</label>
                                <input class="form-control" type="file" name="gambar" id="gambar" accept="image/png, image/jpeg">
                            </div>
                            <div class="card bg-whitesmoke">
                                <div class="card-body">
                                    <p class="mb-0">
                                        Rekening : <br>
                                        BSI : 115235517 a.n Akvin <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="kirim" class="btn btn-sm btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Modal Detail -->
        <div class="modal fade" id="detail<?= $trans->id_pesan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5>ID Pesan : <?= $trans->id_pesan ?> | Penerima : <?= $trans->penerima ?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="width: 10%">Gambar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jumlah Barang</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $trans->id_pesan;
                                $trDetail = transaksiDetail($id)['detail'];

                                foreach ($trDetail as $key => $detail) : ?>
                                    <tr class="border-bottom">
                                        <th scope="row"><?= $key + 1 ?></th>
                                        <td><img src="<?= url ?>assets/images/produk/<?= $detail->gambar ?>" class="w-100" alt=""></td>
                                        <td><?= $detail->nama ?></td>
                                        <td><?= $detail->kuantiti ?></td>
                                        <td>Rp<?= number_format($detail->total, 0) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-uppercase">Ongkir : <?= number_format($trans->ongkir, 0) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Total : <?= number_format($trans->total_akhir, 0) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Status : <?= $trans->keterangan ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../assets/js/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="../assets/js/pooper.js" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/sweetalert2.all.js" crossorigin="anonymous"></script>
<!-- Custom Javascript -->
<script src="../assets/js/custom.js" crossorigin="anonymous"></script>

<script>
    
</script>

</body>

</html>