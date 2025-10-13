<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3>Tambah Produk</h3>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Nama Produk</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Harga</label>
      <input type="number" name="harga" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Kategori</label>
      <select name="kategori" class="form-select" required>
        <option value="">--Pilih--</option>
        <?php
        $kat = mysqli_query($conn, "SELECT * FROM kategori");
        while ($r = mysqli_fetch_assoc($kat)) {
          echo "<option value='{$r['id']}'>{$r['nama_kategori']}</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Deskripsi</label>
      <textarea name="deskripsi" class="form-control"></textarea>
    </div>
    <div class="mb-3">
      <label>Upload Gambar</label>
      <input type="file" name="gambar" class="form-control">
    </div>
    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>

  <?php
  if (isset($_POST['simpan'])) {
      $nama = $_POST['nama'];
      $harga = $_POST['harga'];
      $kategori = $_POST['kategori'];
      $desk = $_POST['deskripsi'];
      $gambar = $_FILES['gambar']['name'];
      $tmp = $_FILES['gambar']['tmp_name'];
      move_uploaded_file($tmp, "images/" . $gambar);

      mysqli_query($conn, "INSERT INTO produk (nama_produk, harga, deskripsi, gambar, kategori_id)
                           VALUES ('$nama','$harga','$desk','$gambar','$kategori')");
      echo "<script>alert('Produk berhasil disimpan');window.location='index.php';</script>";
  }
  ?>
</div>
</body>
</html>
