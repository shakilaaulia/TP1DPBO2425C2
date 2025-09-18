<?php
// Memanggil file ProdukElektronik.php yang berisi class dan fungsi CRUD
require_once 'ProdukElektronik.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk Elektronik</title>
    <!-- include bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h1 class="mb-4">Manajemen Produk Elektronik</h1>

            <!-- menampilkan pesan sukses / error -->
            <?php if ($message): ?>
                <div class="alert <?php echo strpos($message, 'Error') !== false ? 'alert-danger' : 'alert-success'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <!-- form tambah / edit produk -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="h5 mb-3"><?php echo $produkToUpdate ? 'Edit Produk' : 'Tambah Produk'; ?></h2>
                    
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        <!-- menentukan aksi -->
                        <input type="hidden" name="action" value="<?php echo $produkToUpdate ? 'update' : 'tambah'; ?>">

                        <!-- input id produk -->
                        <div class="mb-3">
                            <label for="idProduk" class="form-label">ID Produk</label>
                            <input type="text" id="idProduk" name="idProduk" class="form-control"
                                value="<?php echo $produkToUpdate ? htmlspecialchars($produkToUpdate->idProduk) : ''; ?>"
                                <?php echo $produkToUpdate ? 'readonly' : 'required'; ?>>
                        </div>

                        <!-- input nama produk -->
                        <div class="mb-3">
                            <label for="namaProduk" class="form-label">Nama Produk</label>
                            <input type="text" id="namaProduk" name="namaProduk" class="form-control"
                                value="<?php echo $produkToUpdate ? htmlspecialchars($produkToUpdate->namaProduk) : ''; ?>"
                                required>
                        </div>

                        <!-- input kategori -->
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" id="kategori" name="kategori" class="form-control"
                                value="<?php echo $produkToUpdate ? htmlspecialchars($produkToUpdate->kategori) : ''; ?>"
                                required>
                        </div>

                        <!-- input stok -->
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" id="stok" name="stok" class="form-control"
                                value="<?php echo $produkToUpdate ? htmlspecialchars($produkToUpdate->stok) : ''; ?>"
                                required>
                        </div>

                        <!-- input harga -->
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" id="harga" name="harga" class="form-control"
                                value="<?php echo $produkToUpdate ? htmlspecialchars($produkToUpdate->harga) : ''; ?>"
                                required>
                        </div>

                        <!-- input gambar -->
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar</label>
                            <input type="file" id="gambar" name="gambar" class="form-control" <?php echo $produkToUpdate ? '' : 'required'; ?>>
                            <?php if ($produkToUpdate && $produkToUpdate->gambar): ?>
                                <small class="text-muted">Gambar saat ini:
                                    <?php echo htmlspecialchars($produkToUpdate->gambar); ?></small>
                            <?php endif; ?>
                        </div>

                        <!-- tombol submit -->
                        <button type="submit" name="<?php echo $produkToUpdate ? 'update' : 'tambah'; ?>"
                            class="btn btn-success">
                            <?php echo $produkToUpdate ? 'Update Produk' : 'Tambah Produk'; ?>
                        </button>
                        <?php if ($produkToUpdate): ?>
                            <a href="index.php" class="btn btn-secondary ms-2">Batal</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <!-- daftar produk -->
            <h2 class="h5">Daftar Produk</h2>

            <!-- form pencarian -->
            <form method="get" class="row g-3 mb-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari produk..."
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <!-- jika tidak ada data produk -->
            <?php if (empty($_SESSION['daftarProduk'])): ?>
                <p class="text-muted">Data produk belum ada.</p>
            <?php else: ?>
                <!-- tabel daftar produk -->
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Gambar</th>
                                <th>ID Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $daftarProduk = $_SESSION['daftarProduk'] ?? [];

                            // filter pencarian
                            if (!empty($_GET['search'])) {
                                $keyword = strtolower(trim($_GET['search']));
                                $daftarProduk = array_filter($daftarProduk, function ($produk) use ($keyword) {
                                    return strpos(strtolower($produk->idProduk), $keyword) !== false ||
                                        strpos(strtolower($produk->namaProduk), $keyword) !== false ||
                                        strpos(strtolower($produk->kategori), $keyword) !== false;
                                });
                            }
                            ?>
                            <?php foreach ($daftarProduk as $produk): ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="<?php echo htmlspecialchars($produk->gambar); ?>"
                                            alt="<?php echo htmlspecialchars($produk->namaProduk); ?>"
                                            style="max-width: 100px;">
                                    </td>
                                    <td><?php echo htmlspecialchars($produk->idProduk); ?></td>
                                    <td><?php echo htmlspecialchars($produk->namaProduk); ?></td>
                                    <td><?php echo htmlspecialchars($produk->kategori); ?></td>
                                    <td><?php echo htmlspecialchars($produk->stok); ?></td>
                                    <td>Rp. <?php echo number_format($produk->harga, 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="?action=edit&id=<?php echo urlencode($produk->idProduk); ?>"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="?action=hapus&id=<?php echo urlencode($produk->idProduk); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- include bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
