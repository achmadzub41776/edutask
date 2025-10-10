<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Toko Online Sederhana</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <h2 class="text-center mb-4">🛍️ Toko Online Sederhana</h2>

  <!-- Filter Kategori -->
  <form method="GET" class="mb-4">
    <div class="row">
      <div class="col-md-4">
        <select name="kategori" class="form-select">
          <option value="">Semua Kategori</option>
          <?php
          $q = mysqli_query($conn, "SELECT * FROM kategori");
          while ($r = mysqli_fetch_assoc($q)) {
              $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $r['id']) ? 'selected' : '';
              echo "<option value='{$r['id']}' $selected>{$r['nama_kategori']}</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
      </div>
      <div class="col-md-2">
        <a href="add_product.php" class="btn btn-success w-100">+ Tambah Produk</a>
      </div>
    </div>
  </form>

  <!-- Produk Grid -->
  <div class="row">
    <?php
    $filter = "";
    if (isset($_GET['kategori']) && $_GET['kategori'] != "") {
        $filter = "WHERE p.kategori_id = " . intval($_GET['kategori']);
    }

    $query = mysqli_query($conn, "SELECT p.*, k.nama_kategori FROM produk p
                                  LEFT JOIN kategori k ON p.kategori_id = k.id $filter
                                  ORDER BY p.id DESC");

    while ($data = mysqli_fetch_assoc($query)) {
    ?>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm">
        <img src="images/<?php echo $data['gambar']; ?>" class="card-img-top" style="height:200px; object-fit:cover;">
        <div class="card-body">
          <h5 class="card-title"><?php echo $data['nama_produk']; ?></h5>
          <p class="card-text text-muted"><?php echo $data['nama_kategori']; ?></p>
          <p class="card-text">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
          <p class="small"><?php echo $data['deskripsi']; ?></p>
          <a href="edit_product.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="delete_product.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

</body>
</html>
