<?php
require '../function/pengguna.php';
require '../function/cart.php';
require '../function/transaksi.php';

$profil = profil();
$judul = $profil['judul'];
$user = $profil['pengguna'];
$tab = array_key_exists('tab', $_POST) ? $_POST['tab'] : (array_key_exists('tab', $_GET) ? $_GET['tab'] : 'home');

if (isset($_POST['ubahCart'])) {
    ubahCart($_POST);
} else if (isset($_POST['hapusCart'])) {
    hapusCart($_POST);
} else if (isset($_POST['bersihkanCart'])) {
    bersihkanCart($_POST);
}

$transaksi = ambilTransaksi()['trans'];
if (isset($_POST['kirim'])) {
    bayar($_POST);
}

if (isset($_POST['terima'])) {
    terimaTransaksi($_POST);
}

$cart = ambilCart()['carts'];
$subtotal = ambilCart()['subtotal']->subtotal;


require 'templates/header.php';
?>

<div class="row border mt-5 py-3">
    <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?php echo ($tab == 'home' ? 'active' : '') ?>" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-selected="<?php echo ($tab == 'home' ? 'true' : 'false') ?>">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($tab == 'cart' ? 'active' : '') ?>" id="tab-keranjang" data-toggle="pill" href="#keranjang" role="tab" aria-selected="<?php echo ($tab == 'cart' ? 'true' : 'false') ?>">Keranjang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($tab == 'transaksi' ? 'active' : '') ?>" id="tab-transaksi" data-toggle="pill" href="#transaksi" role="tab" aria-selected="<?php echo ($tab == 'transaksi' ? 'true' : 'false') ?>">Transaksi</a>
            </li>
        </ul>
    </div>
    <div class="col-md-12 ">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade <?php echo ($tab == 'home' ? 'show active' : '') ?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <ul class="list-group list-group-flush w-50">
                    <li class="list-group-item">
                        <img src="<? url ?>assets/images/user/<?= $user->image ?>" alt="">
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold">Nama</h6><?= $user->nama ?>
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold">Email</h6><?= $user->email ?>
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold">Terakhir masuk</h6><?= $_SESSION['tglMasuk'] ?>
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold">Daftar pada</h6><?= $user->createat ?>
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold"> Di perbarui pada</h6><?= $user->updateat ?>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade <?php echo ($tab == 'cart' ? 'show active' : '') ?>" id="keranjang" role="tabpanel" aria-labelledby="tab-keranjang">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 10%">Gambar</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col" style="width: 10%">Jumlah Barang</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $key => $value) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><img style="width: 100%" src="../assets/images/produk/<?= $value->gambar ?>" alt=""></td>
                                <td><a href="../user/produk.php?id=<?= $value->id_produk ?>"><?= $value->nama ?></a></td>
                                <td>Rp<?= number_format($value->harga, 0) ?></td>

                                <form action="" method="POST">
                                    <td>
                                        <input class="form-control w-100 quantity number-cleave text-right" data-cart-id="<?= $value->id_cart ?>" min="1" max="<?= $value->stok ?>" type="text" name="kuantiti" value="<?= $value->kuantiti ?>">
                                        <small class="text-muted">
                                            Max : <?= $value->stok ?>
                                        </small>
                                    </td>
                                    <td>Rp
                                        <span class="formatted-total" data-cart-id="<?= $value->id_cart ?>">
                                            <?= number_format($value->total, 0) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <input type="hidden" name="tab" value="cart">
                                        <input type="hidden" name="idCart" value="<?= $value->id_cart ?>">
                                        <input type="hidden" name="harga" value="<?= $value->harga ?>">
                                        <button name="hapusCart" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        <!-- <button name="ubahCart" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button> -->
                                    </td>
                                </form>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total :</td>
                            <td colspan="3"> Rp
                                <span id="total">
                                    <?= number_format($subtotal, 0) ?>
                                </span>    
                            </td>
                        </tr>
                        <tr>
                            <form action="" method="POST">
                                <td><button name="bersihkanCart" class="btn btn-sm btn-success">Bersihkan isi keranjang</button></td>
                            </form>
                            <td colspan="3"><a class="btn btn-sm btn-success" href="<?= url ?>user/cekOut.php">Checkout</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade <?php echo ($tab == 'transaksi' ? 'show active' : '') ?>" id="transaksi" role="tabpanel" aria-labelledby="tab-transaksi">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID PESAN</th>
                            <th scope="col">PENERIMA</th>
                            <th scope="col">PENGIRIM</th>
                            <th scope="col">JUMLAH</th>
                            <th scope="col">TOTAL HARGA</th>
                            <th scope="col">ONGKIR</th>
                            <th scope="col" class="text-center">STATUS</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $key => $trans) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><?= $trans->id_pesan ?></td>
                                <td><?= $trans->penerima ?></td>
                                <td><?= $trans->pengirim ?></td>
                                <td><?= $trans->kuantiti_total ?></td>
                                <td>Rp<?= number_format($trans->total_akhir, 0) ?></td>
                                <td>Rp<?= number_format($trans->ongkir, 0) ?></td>
                                <td class="text-center">
                                    <?php if ($trans->id_status == 0 && $trans->pembayaran == 0) : ?>
                                        <span class=" badge badge-warning">Anda belum melakukan pembayaran</span>
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#bayar<?= $trans->id_pesan ?>">
                                            Bayar
                                        </button>
                                    <?php elseif ($trans->id_status == 0 && $trans->pembayaran == 1) : ?>
                                        <span class=" badge badge-warning">Menunggu verifikasi</span>
                                    <?php elseif ($trans->id_status == 1) : ?>
                                        <span class="badge badge-secondary"><?= $trans->keterangan ?></span>
                                    <?php elseif ($trans->id_status == 2) : ?>
                                        <span class="badge badge-primary"><?= $trans->keterangan ?></span>
                                        <form action="" method="POST">
                                            <input type="hidden" name="idpesan" value="<?= $trans->id_pesan ?>">
                                            <button name="terima" class="mt-1 btn btn-sm btn-primary">Terima</button>
                                        </form>
                                    <?php elseif ($trans->id_status == 3) : ?>
                                        <span class="badge badge-success"><?= $trans->keterangan ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-right" style="
                                        width: 150px;
                                    ">
                                    <?php if($trans->id_status >= 1) : ?>
                                        <a href="./invoice.php?id=<?= $trans->id ?>" target="_blank" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-print"></i>
                                    </a>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail<?= $trans->id_pesan ?>">Detail</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
         
        </div>
    </div>
</div>
<?php require 'templates/footer.php' ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.0.2/cleave.min.js" integrity="sha512-SvgzybymTn9KvnNGu0HxXiGoNeOi0TTK7viiG0EGn2Qbeu/NFi3JdWrJs2JHiGA1Lph+dxiDv5F9gDlcgBzjfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.number-cleave').toArray().forEach(function(field) {
        new Cleave(field, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            delimiter: '',
            numeralDecimalScale: 0
        })
    })
    $('.quantity').on('keyup', function() {
        let quantity = parseInt($(this).val());
        let stock = parseInt($(this).attr('max'));
        let cartId = $(this).data('cart-id');
        console.log(quantity, stock);
        if(quantity > stock) {
            alert('Jumlah barang melebihi stok yang tersedia!');
            $(this).val(stock);
            quantity = stock;
        }

        //ajax request .count-cart.php
        $.ajax({
            url: './count-cart.php',
            data: {
                quantity: quantity,
                cartId: cartId
            },
            method: 'POST',
            success: function(response) {
                response = JSON.parse(response);
                $('.formatted-total[data-cart-id="' + cartId + '"]').html(response.data.total);
                $('#total').html(response.data.grandTotal);
            }
        });
    });

</script>