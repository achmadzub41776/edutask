<?php
// Cek apakah form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $nama = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $qty = htmlspecialchars($_POST['qty']);	

    // Validasi sederhana
    if (empty($nama) || empty($deskripsi)) {
        echo "Semua field harus diisi!";
    } else {
        // Tampilkan hasil input
        echo "<h2>Data yang Anda kirim:</h2>";
        echo "Nama Barang: " . $nama . "<br>";
        echo "Harga Barang: " . $harga . "<br>";
        echo "deskripsi: " . $deskripsi . "<br>";
		echo "Stok: " . $qty . "<br>";
    }
} else {
    echo "Form belum dikirim!";
}
?>
