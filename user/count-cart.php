<?php
require '../function/koneksi.php';
global $konek;
session_start();
$quantity = $_POST['quantity'];
$cartId = $_POST['cartId'];
$id = $_SESSION['iduser'];

$cart = mysqli_query($konek, "SELECT * FROM cart WHERE id_cart='$cartId'");
$produk = mysqli_fetch_object($cart);

$total = $produk->harga * $quantity;

//update cart
mysqli_query($konek, "UPDATE cart SET kuantiti='$quantity', total='$total' WHERE id_cart='$cartId'");
$grandTotal = mysqli_query($konek, "SELECT SUM(total) as total FROM cart WHERE id_user='$id'");
$grandTotal = mysqli_fetch_object($grandTotal)->total;

echo json_encode([
    'status' => 'success',
    'message' => 'Berhasil mengubah keranjang',
    'data' => [
        'quantity' => $quantity,
        'total' => number_format($total, 0),
        'grandTotal' => number_format($grandTotal, 0)
    ]
]);