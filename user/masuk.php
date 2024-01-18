<?php
session_start();
require '../function/koneksi.php';
require '../function/auth.php';

$judul = 'Daftarkan akun anda';

if (isset($_POST['login'])) {
    masuk($_POST);
}

require 'templates/header.php';
?>
<div class="row pt-5">
    <div class="col">
        <div class="row mt-5">
            <div class="col border-bottom">
                <h4 class="text-center">MASUK</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md bg-light my-3" style="display: flex;">

                <form class="w-75 py-4 m-auto" action="" method="POST">
                    <div class="form-group">
                        <label for="Email" style="margin-left: 140px;">Email</label>
                        <input type="email" class="form-control" placeholder="Email anda" id="Email" required name="email" style="width: 500px; margin-left: 140px;">
                    </div>
                    <div class="form-group ">
                        <label for="password" style="margin-left: 140px;">Kata Sandi</label>
                        <input type="password" class="form-control" placeholder="Sandi anda" id="password" required name="sandi" autocomplete="off" style="width: 500px;  margin-left: 140px;">
                    </div>
                    <div class="text-center">
                        <button name="login" type="submit" class="btn btn-primary" style="width: 500px;">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'templates/footer.php'; ?>