<?php
session_start();
include 'config.php';

$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$produk = mysqli_fetch_assoc($q);

if (!$produk) {
    die("Produk tidak ditemukan.");
}

// Jika belum ada keranjang, buat array kosong
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Jika produk sudah ada di keranjang, tambahkan jumlahnya
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['id'] == $id) {
        $item['qty']++;
        $found = true;
        break;
    }
}

// Jika produk belum ada, tambahkan baru
if (!$found) {
    $_SESSION['cart'][] = [
        'id' => $produk['id'],
        'nama' => $produk['nama_produk'],
        'harga' => $produk['harga'],
        'gambar' => $produk['gambar'],
        'qty' => 1
    ];
}

header("Location: cart.php");
?>
