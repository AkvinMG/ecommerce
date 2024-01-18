<?php
session_start();
require '../function/koneksi.php';
require '../function/auth.php';
require '../function/cart.php';

$judul = 'Daftarkan akun anda';

if (isset($_POST['daftar'])) {
    daftar($_POST);
}


require 'templates/header.php';
?>
<div class="row pt-5">
    <div class="col">
        <div class="row mt-5">
            <div class="col border-bottom">
                <h4 class="text-center">DAFTAR</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md bg-light my-3">

                <form class="w-75 py-4 m-auto" action="" method="POST">
                    <div class="form-group">
                        <label for="nama" style="margin-left: 140px;">Nama</label>
                        <input type="text" class="form-control" id="nama" required name="nama"  style="width: 500px; margin-left: 140px;">
                    </div>
                    <div class="form-group">
                        <label for="Email" style="margin-left: 140px;">Email</label>
                        <input type="email" class="form-control" id="Email" required name="email"  style="width: 500px; margin-left: 140px;">
                    </div>
                    <div class="form-group ">
                        <label for="Password" style="margin-left: 140px;">Kata Sandi</label>
                        <input type="password" class="form-control border-right-0" id="password" required name="sandi1" autocomplete="off"  style="width: 500px; margin-left: 140px;">
                    </div>
                    <div class="form-group ">
                        <label for="password" style="margin-left: 140px;">Ulangi Sandi</label>
                        <input type="password" class="form-control border-right-0" id="password" required name="sandi2" autocomplete="off"  style="width: 500px; margin-left: 140px;">
                            
                    </div>
                    <div class="text-center">
                        <button name="daftar" type="submit" class="btn btn-primary"  style="width: 500px;">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'templates/footer.php'; ?>