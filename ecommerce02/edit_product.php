<?php include 'config.php';
$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM produk WHERE id=$id");
$data = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3>Edit Produk</h3>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Nama Produk</label>
      <input type="text" name="nama" value="<?php echo $data['nama_produk']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Harga</label>
      <input type="number" name="harga" value="<?php echo $data['harga']; ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Deskripsi</label>
      <textarea name="deskripsi" class="form-control"><?php echo $data['deskripsi']; ?></textarea>
    </div>
    <div class="mb-3">
      <label>Gambar</label><br>
      <img src="images/<?php echo $data['gambar']; ?>" width="120"><br>
      <input type="file" name="gambar" class="form-control mt-2">
    </div>
    <button type="submit" name="update" class="btn btn-warning">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>

  <?php
  if (isset($_POST['update'])) {
      $nama = $_POST['nama'];
      $harga = $_POST['harga'];
      $desk = $_POST['deskripsi'];

      if ($_FILES['gambar']['name'] != "") {
          $gambar = $_FILES['gambar']['name'];
          $tmp = $_FILES['gambar']['tmp_name'];
          move_uploaded_file($tmp, "images/" . $gambar);
      } else {
          $gambar = $data['gambar'];
      }

      mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', harga='$harga', deskripsi='$desk', gambar='$gambar' WHERE id=$id");
      echo "<script>alert('Produk berhasil diupdate');window.location='index.php';</script>";
  }
  ?>
</div>
</body>
</html>
