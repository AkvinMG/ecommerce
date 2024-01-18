<?php

require '../function/transaksi.php';

session_start();

$id = $_GET['id'];
$result = mysqli_query($konek, "SELECT * FROM transaksi JOIN status ON status.id_status = transaksi.id_status  WHERE id='$id'");
$trans = mysqli_fetch_object($result);

?>

<html>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" crossorigin="anonymous">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" crossorigin="anonymous">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../assets/css/custom.css" crossorigin="anonymous">
    </head>
    <body>
        
        <h5>ID Pesan : <?= $trans->id_pesan ?> | Penerima : <?= $trans->penerima ?> </h5>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col" class="table-fit">#</th>
                    <th scope="col" class="table-fit">Gambar</th>
                    <th scope="col">Nama</th>
                    <th scope="col" class="table-fit">Jumlah Barang</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id = $trans->id_pesan;
                $trDetail = transaksiDetail($id)['detail'];

                foreach ($trDetail as $key => $detail) : ?>
                    <tr class="border-bottom">
                        <th scope="row" class="table-fit"><?= $key + 1 ?></th>
                        <td><img src="<?= url ?>assets/images/produk/<?= $detail->gambar ?>" class="table-fit w-100" alt=""></td>
                        <td><?= $detail->nama ?></td>
                        <td class="table-fit"><?= $detail->kuantiti ?></td>
                        <td class="table-fit text-right">Rp<?= number_format($detail->total, 0) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-uppercase" colspan="5">Ongkir : <?= number_format($trans->ongkir, 0) ?></td>
                </tr>
                <tr>
                    <td class="text-uppercase" colspan="5">Total : <?= number_format($trans->total_akhir, 0) ?></td>
                </tr>
                <tr>
                    <td class="text-uppercase" colspan="5">Status : <?= $trans->keterangan ?></td>
                </tr>
            </tfoot>
        </table>

        <script>
            //print page
            window.print();
        </script>
    </body>
</html>


