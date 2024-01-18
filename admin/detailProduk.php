<?php
require '../function/admin.php';
if (cekLoginAdmin() === false) {
    $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    header('location:../user/masuk.php');
}

$id = $_GET['id'];
$produk = detailProduk($id);
$judul = $produk['judul'];

// ---- Ubah Produk ----//
if (isset($_POST['ubah'])) {
    ubahProduk($id, $_POST);
}

require 'template_admin/header.php';
?>
<div class=" detail-produk p-3 mt-3 bg-primary text-light ">
    <div class="judul">
        <h5>Detail Produk <?= $produk['produk']->kategori . " " . $produk['produk']->nama ?></h5>
    </div>
    <div class="card w-100 text-dark my-3" style="width: 18rem;">
        <img style="" src="../assets/images/produk/<?= $produk['produk']->gambar ?>" class="card-img-top m-auto w-25" alt="...">
        <div class="card-body border-top">
            <h5 class="card-title"><?= $produk['produk']->nama ?></h5>
            <p class="card-text"><?= $produk['produk']->deskripsi ?></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Harga : Rp<?= number_format($produk['produk']->harga, 0) ?></li>
            <li class="list-group-item">Stok : <?= $produk['produk']->stok ?></li>
            <li class="list-group-item">Kategori : <?= $produk['produk']->kategori ?></li>
        </ul>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <form action="../admin/produk.php?id=<?= $produk['produk']->id_produk ?>" method="POST">
                        <button class="hapus btn btn-sm btn-danger ml-2 btn-block" name="hapus">Hapus</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <button class="ubah btn btn-sm btn-primary btn-block" href="#" class="card-link">Ubah</button>
                </div>
            </div>
            <!-- <button onclick="location.href=''" class="btn btn-sm btn-danger" class="card-link">Hapus</button> -->
        </div>
    </div>
    <div id="ubah-data">
        <div class="card w-100 text-dark ">
            <div class="card-body border-top">
                <h5 class="card-title text-uppercase">Ubah Data</h5>
            </div>
            <form class="ml-3" method="POST" action="../function/admin.php?id=<?= $produk['produk']->id_produk ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group mx-2 col-sm-5 ">
                        <label for="nama">Nama</label>
                        <input class="form-control " type="text" name="nama" id="nama" value="<?= $produk['produk']->nama ?>">
                    </div>
                    <div class="form-group mx-2 col-sm-5 ">
                        <label for="harga">harga</label>
                        <input class="form-control " type="number" name="harga" id="harga" value="<?= $produk['produk']->harga ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mx-2 col-sm-5 ">
                        <label for="kategori">kategori</label>
                        <select class="form-control " name="kategori" id="">
                            <option>--Pilih--</option>
                            <option value="Baju" <?php echo $produk['produk']->kategori == 'Baju' ? 'selected' : '' ?> >Baju</option>
                            <option value="Celana" <?php echo $produk['produk']->kategori == 'Celana' ? 'selected' : '' ?>>Celana</option>
                            <option value="Rok" <?php echo $produk['produk']->kategori == 'Rok' ? 'selected' : '' ?>>Rok</option>
                            <option value="Jilbab" <?php echo $produk['produk']->kategori == 'Jilbab' ? 'selected' : '' ?>>Jilbab</option>
                            <option value="Mukena" <?php echo $produk['produk']->kategori == 'Mukena' ? 'selected' : '' ?>>Mukena</option>
                        </select>
                    </div>
                    <div class="form-group mx-2 col-sm-5 ">
                        <label for="stok">stok</label>
                        <input class="form-control " type="number" name="stok" id="stok" value="<?= $produk['produk']->stok ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mx-2 col-sm-5 ">
                        <label for="deskripsi">deskripsi</label>
                        <textarea class="form-control " type="text" name="deskripsi" id="deskripsi"><?= $produk['produk']->deskripsi ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group mx-2 col-sm-3 ">
                        <label for="gambar">gambar</label>
                        <input class="form-control " type="file" name="gambar" id="gambar">
                    </div>
                </div>
                <input type="hidden" name="create" value="<?= $produk['produk']->create ?>">
                <div class=" text-center my-3">
                    <button type="submit" name="ubah" class="btn btn-sm btn-primary w-25" class="card-link">Simpan</button>
                    <a id="ubah-data-href" href="../admin/detailproduk.php?id=<?= $produk['produk']->id_produk ?>" class="btn btn-sm btn-danger w-25" class="card-link">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'template_admin/footer.php' ?>