<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
  <h2 class="mb-4">🛒 Keranjang Belanja</h2>
  <a href="index.php" class="btn btn-secondary mb-3">⬅ Kembali Belanja</a>

  <?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) { ?>
    <div class="alert alert-warning">Keranjang masih kosong.</div>
  <?php } else { ?>
    <form method="POST" action="">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $grandtotal = 0;
          foreach ($_SESSION['cart'] as $key => $item) {
              $total = $item['harga'] * $item['qty'];
              $grandtotal += $total;
          ?>
          <tr>
            <td><img src="images/<?php echo $item['gambar']; ?>" width="80"></td>
            <td><?php echo $item['nama']; ?></td>
            <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
            <td>
              <input type="number" name="qty[<?php echo $key; ?>]" value="<?php echo $item['qty']; ?>" class="form-control" style="width:80px;">
            </td>
            <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
            <td>
              <a href="cart.php?remove=<?php echo $key; ?>" class="btn btn-danger btn-sm">Hapus</a>
            </td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="4" class="text-end fw-bold">Total Keseluruhan</td>
            <td colspan="2" class="fw-bold text-success">Rp <?php echo number_format($grandtotal, 0, ',', '.'); ?></td>
          </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-between">
        <button type="submit" name="update" class="btn btn-primary">Update Jumlah</button>
        <a href="cart.php?clear=1" class="btn btn-outline-danger">Kosongkan Keranjang</a>
      </div>
    </form>
  <?php } ?>

  <?php
  // Update jumlah
  if (isset($_POST['update'])) {
      foreach ($_POST['qty'] as $key => $value) {
          $_SESSION['cart'][$key]['qty'] = max(1, intval($value));
      }
      echo "<script>window.location='cart.php';</script>";
  }

  // Hapus item
  if (isset($_GET['remove'])) {
      unset($_SESSION['cart'][$_GET['remove']]);
      $_SESSION['cart'] = array_values($_SESSION['cart']); // reset index
      echo "<script>window.location='cart.php';</script>";
  }

  // Kosongkan keranjang
  if (isset($_GET['clear'])) {
      unset($_SESSION['cart']);
      echo "<script>window.location='cart.php';</script>";
  }
  ?>
</div>

</body>
</html>
