<?php
session_start();

// ======================
// DATA PRODUK (STATIS)
// ======================
$products = [
    1 => ["name" => "Sepatu Sneakers", "price" => 250000, "desc" => "Sepatu nyaman untuk aktivitas harian."],
    2 => ["name" => "Tas Kulit", "price" => 350000, "desc" => "Tas kulit elegan untuk kerja atau kuliah."],
    3 => ["name" => "Jam Tangan", "price" => 500000, "desc" => "Jam tangan elegan dengan desain minimalis."],
];

// ======================
// TAMBAH PRODUK KE KERANJANG
// ======================
if (isset($_GET['add'])) {
    $id = $_GET['add'];
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }
    header("Location: index.php");
    exit;
}

// ======================
// HAPUS PRODUK DARI KERANJANG
// ======================
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: index.php");
    exit;
}

// ======================
// HITUNG TOTAL
// ======================
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $qty) {
        $total += $products[$id]['price'] * $qty;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Online Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">🛒 Toko Online Sederhana</a>
        <span class="navbar-text text-white">
            Keranjang: <?= isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0 ?> barang
        </span>
    </div>
</nav>

<div class="container mt-4">
    <h3>Daftar Produk</h3>
    <div class="row">
        <?php foreach ($products as $id => $p): ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5><?= $p['name'] ?></h5>
                    <p><?= $p['desc'] ?></p>
                    <h6>Rp <?= number_format($p['price'], 0, ',', '.') ?></h6>
                    <a href="?add=<?= $id ?>" class="btn btn-primary btn-sm">Tambah ke Keranjang</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <hr>
    <h4>Keranjang Belanja</h4>
    <?php if (!empty($_SESSION['cart'])): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $id => $qty): ?>
            <tr>
                <td><?= $products[$id]['name'] ?></td>
                <td><?= $qty ?></td>
                <td>Rp <?= number_format($products[$id]['price'], 0, ',', '.') ?></td>
                <td>Rp <?= number_format($products[$id]['price'] * $qty, 0, ',', '.') ?></td>
                <td><a href="?remove=<?= $id ?>" class="btn btn-danger btn-sm">Hapus</a></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" class="text-end"><strong>Total Belanja:</strong></td>
                <td colspan="2"><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
            </tr>
        </tbody>
    </table>
    <?php else: ?>
        <p>Keranjang masih kosong.</p>
    <?php endif; ?>
</div>

</body>
</html>
