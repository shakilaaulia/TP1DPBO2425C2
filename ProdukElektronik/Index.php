<?php
require_once "ProdukElektronik.php";

// inisialisasi session
if (!isset($_SESSION['daftarProduk'])) {
    $_SESSION['daftarProduk'] = [];
}

$message = "";
$messageType = "";
$produkToUpdate = null;
// tambah produk
if (isset($_POST['tambah'])) {
    $id = $_POST['idProduk'];
    $nama = $_POST['namaProduk'];
    $kategori = $_POST['kategori'];
    $stok = (int) $_POST['stok'];
    $harga = (int) $_POST['harga'];

    if (ProdukElektronik::cariId($id)) {
        $_SESSION['message'] = "ID produk sudah ada, gunakan ID lain!";
        $_SESSION['messageType'] = "danger";
    } else {
        $gambar = "gambar/default.png";
        if (!empty($_FILES['gambar']['name'])) {
            $targetDir = "gambar/";
            $fileName = time() . "_" . basename($_FILES["gambar"]["name"]);
            $targetFile = $targetDir . $fileName;
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                $gambar = $targetFile;
            }
        }

        $produk = new ProdukElektronik($id, $nama, $kategori, $stok, $harga, $gambar);
        ProdukElektronik::tambahProduk($produk);

        $_SESSION['message'] = "Produk berhasil ditambahkan.";
        $_SESSION['messageType'] = "success";
    }

    header("Location: Index.php");
    exit;
}

// update produk
if (isset($_POST['update'])) {
    $produk = ProdukElektronik::getProdukById($_POST['idProduk']);
    if ($produk) {
        $nama = $_POST['namaProduk'];
        $kategori = $_POST['kategori'];
        $stok = (int) $_POST['stok'];
        $harga = (int) $_POST['harga'];

        $gambar = null;
        if (!empty($_FILES['gambar']['name'])) {
            $targetDir = "gambar/";
            $fileName = time() . "_" . basename($_FILES["gambar"]["name"]);
            $targetFile = $targetDir . $fileName;
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                $gambar = $targetFile;
            }
        }

        $produk->updateProduk($nama, $kategori, $stok, $harga, $gambar);

        $_SESSION['message'] = "Produk berhasil diupdate.";
        $_SESSION['messageType'] = "success";
    }

    header("Location: Index.php");
    exit;
}


// hapus produk
if (isset($_GET['hapus'])) {
    ProdukElektronik::hapusProduk($_GET['hapus']);
    $message = "Produk berhasil dihapus.";
    $messageType = "success";
    header("Location: Index.php");
}

// ambil produk untuk edit
if (isset($_GET['edit'])) {
    $produkToUpdate = ProdukElektronik::getProdukById($_GET['edit']);
}

// search produk
$hasilCari = [];
if (isset($_GET['search'])) {
    $keyword = trim($_GET['keyword']);
    $hasilCari = ProdukElektronik::cariProduk($keyword);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Produk Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h1 class="mb-4">Manajemen Produk Elektronik</h1>

        <!-- notifikasi -->
        <?php if ($message): ?>
            <div class="alert <?= $messageType === 'success' ? 'alert-success' : 'alert-danger'; ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- form tambah/edit -->
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="h5 mb-3"><?= $produkToUpdate ? 'Edit Produk' : 'Tambah Produk'; ?></h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">ID Produk</label>
                        <input type="text" name="idProduk" class="form-control"
                               value="<?= $produkToUpdate ? $produkToUpdate->getIdProduk() : ''; ?>"
                               <?= $produkToUpdate ? 'readonly' : 'required'; ?>>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="namaProduk" class="form-control"
                               value="<?= $produkToUpdate ? $produkToUpdate->getNamaProduk() : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control"
                               value="<?= $produkToUpdate ? $produkToUpdate->getKategori() : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control"
                               value="<?= $produkToUpdate ? $produkToUpdate->getStok() : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control"
                               value="<?= $produkToUpdate ? $produkToUpdate->getHarga() : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Gambar</label>
                        <input type="file" name="gambar" class="form-control" <?= $produkToUpdate ? '' : 'required'; ?>>
                        <?php if ($produkToUpdate): ?>
                            <small class="text-muted">Gambar saat ini: <?= htmlspecialchars($produkToUpdate->getGambar()); ?></small>
                        <?php endif; ?>
                    </div>

                    <button type="submit" name="<?= $produkToUpdate ? 'update' : 'tambah'; ?>" class="btn btn-success">
                        <?= $produkToUpdate ? 'Update Produk' : 'Tambah Produk'; ?>
                    </button>
                    <?php if ($produkToUpdate): ?>
                        <a href="Index.php" class="btn btn-secondary">Batal</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>


        <!-- daftar produk -->
        <h2 class="h5">Daftar Produk</h2>
        
        <!-- form search -->
        <form method="get" class="mb-3 d-flex">
            <input type="text" name="keyword" class="form-control me-2" placeholder="Cari produk..." required>
            <button type="submit" name="search" class="btn btn-primary">Cari</button>
        </form>
        <?php
        $listProduk = isset($_GET['search']) ? $hasilCari : $_SESSION['daftarProduk'];
        if (empty($listProduk)):
        ?>
            <p class="text-muted">Belum ada data produk.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($listProduk as $produk): ?>
                        <tr>
                            <td><?= htmlspecialchars($produk->getIdProduk()); ?></td>
                            <td><img src="<?= $produk->getGambar(); ?>" style="max-width: 100px;"></td>
                            <td><?= htmlspecialchars($produk->getNamaProduk()); ?></td>
                            <td><?= htmlspecialchars($produk->getKategori()); ?></td>
                            <td><?= htmlspecialchars($produk->getStok()); ?></td>
                            <td>Rp. <?= number_format($produk->getHarga(), 0, ',', '.'); ?></td>
                            <td>
                                <a href="?edit=<?= urlencode($produk->getIdProduk()); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?hapus=<?= urlencode($produk->getIdProduk()); ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin hapus produk ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
