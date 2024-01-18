<?php
session_start();
require '../function/cart.php';
require '../function/transaksi.php';

$judul = transaksi()['judul'];

$subtotal = ambilCart()['subtotal']->subtotal;
$kuantiti = ambilCart()['kuantiti']->kuantiti;
$carts = ambilCart()['carts'];

if (isset($_POST['submit'])) {
    tambahTransaksi($_POST);
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 606f38eed4e4aa09cfd94aca5a272656"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$response = json_decode($response, true);
//get results
$provinces = $response['rajaongkir']['results'];
//close connection
curl_close($curl);


require 'templates/header.php';
?>
<div class="row mt-5">
    <h5 class="w-100">Pembelian</h5>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <h6>Jumlah Barang</h6><span><?= $kuantiti ?></span>
        </li>
        <li class="list-group-item">
            <h6>Total Harga</h6><span>Rp<?= number_format($subtotal, 0) ?></span>
        </li>
    </ul>
</div>
<div class="row mt-2">
    <h5 class="w-100">Form CekOut</h5>
    <div class="col-md-8">
        <form action="" method="POST">

            <input type="hidden" name="kuantiti_total" value="<?= $kuantiti ?>">
            <input type="hidden" name="subtotal" value="<?= $subtotal ?>">
            <?php
            $i = 1;
            foreach ($carts as $value) : ?>
                <input type="hidden" name="kuantiti<?= $i++ ?>" value="<?= $value->kuantiti ?>">
            <?php endforeach; ?>
            <?php $i = 1;
            foreach ($carts as $value) : ?>
                <input type="hidden" name="id_produk<?= $i++ ?>" value="<?= $value->id_produk ?>">
            <?php endforeach; ?>

            <div class="row">
                <!-- <div class="col-md-6 form-group">
                    <label for="pengirim">Pengirim</label>
                    <input type="text" class="form-control" id="pengirim" name="pengirim">
                </div> -->
                <div class="col-md-12 form-group">
                    <label for="penerima">Penerima</label>
                    <input type="text" class="form-control" id="penerima" name="penerima">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="telp">Telepon penerima</label>
                    <input type="number" class="form-control" id="telp" name="telepon">
                </div>
                <div class="col-md-6 form-group">
                    <label for="email">Email penerima</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="provinsi">Provinsi</label>
                    <select class="form-control" id="provinsi" name="provinsi">
                        <option value="">Pilih Provinsi</option>
                        <?php foreach ($provinces as $province) : ?>
                            <option value="<?= $province['province_id'] ?>"><?= $province['province'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="kota">Kota</label>
                    <select class="form-control" id="kota" name="kota">
                        <option value="">Pilih Kota</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="ongkir">Ongkir</label>
                    <input type="number" class="form-control" id="ongkir" name="ongkir" readonly>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary" id="btn-submit" disabled>Submit</button>
        </form>
    </div>
</div>
<?php
require 'templates/footer.php';
?>

<script>
    $(document).ready(function() {
        $('#provinsi').change(function() {
            var provinsi_id = $(this).val();
            //ajax
            $.ajax({
                url: "./city.php",
                type: "POST",
                data: {
                    province: provinsi_id
                },
                cache: false,
                beforeSend: function() {
                    $('#ongkir').val(0);
                    $('#btn-submit').prop('disabled', true);
                    $('#kota').html('<option value="">Loading...</option>');
                },
                success: function(data) {
                    //each data
                    $('#kota').html('');
                    $.each(JSON.parse(data), function(key, value) {
                        //append data to select
                        $('#kota').append('<option value="' + value.city_id + '">' + value.type + ' ' + value.city_name + '</option>');
                    });
                    $('#kota').trigger('change');
                }
            });
        });

        $('#kota').change(function() {
            var kota_id = $(this).val();

            //ajax
            $.ajax({
                url: "./ongkir.php",
                type: "POST",
                data: {
                    city: kota_id,
                },
                cache: false,
                beforeSend: function() {
                    $('#ongkir').val('Loading...');
                    $('#btn-submit').prop('disabled', true);
                },
                success: function(data) {
                    //each data
                    $('#ongkir').val(data);
                    $('#btn-submit').prop('disabled', false);
                }
            });
        });
    });
</script>