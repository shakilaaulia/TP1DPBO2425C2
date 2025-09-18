<?php
session_start(); //meulai session untuk menyimpan data produk

class ProdukElektronik
{
    public $idProduk;
    public $namaProduk;
    public $kategori;
    public $stok;
    public $harga;
    public $gambar;

    // konstruktor untuk inisialisasi objek produk
    public function __construct($idProduk, $namaProduk, $kategori, $stok, $harga, $gambar)
    {
        $this->idProduk = $idProduk;
        $this->namaProduk = $namaProduk;
        $this->kategori = $kategori;
        $this->stok = $stok;
        $this->harga = $harga;
        $this->gambar = $gambar;
    }
}

// inisialisasi daftar produk di session jika belum ada
if (!isset($_SESSION['daftarProduk'])) {
    $_SESSION['daftarProduk'] = [];
}

$message = ''; //variabel untuk menyimpan pesan status (sukses/error)

// fungsi upload gambar ===
function uploadGambar($inputName, $gambarLama = null)
{
    //kika tidak ada file baru yang diupload, kembalikan gambar lama
    if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
        return $gambarLama;
    }

    //pastikan folder 'gambar/' ada, kalau tidak buat baru
    $uploadDir = __DIR__ . '/gambar/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    //buat nama file unik agar tidak bentrok
    $fileName = time() . '_' . basename($_FILES[$inputName]['name']);
    $filePath = $uploadDir . $fileName;
    $filePathRelative = 'gambar/' . $fileName; // path relatif untuk disimpan

    //pindahkan file upload ke folder tujuan
    if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $filePath)) {
        return $filePathRelative; // return path gambar yang berhasil diupload
    }

    return $gambarLama; // kalau gagal upload, gunakan gambar lama
}

// fungsi untuk menambah produk baru 
function tambahData()
{
    global $message;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah'])) {
        //ambil data dari form
        $idProduk = $_POST['idProduk'];
        $namaProduk = $_POST['namaProduk'];
        $kategori = $_POST['kategori'];
        $stok = (int) $_POST['stok'];
        $harga = (int) $_POST['harga'];
        $gambar = uploadGambar('gambar');

        // cek apakah id produk sudah ada
        foreach ($_SESSION['daftarProduk'] as $produk) {
            if ($produk->idProduk === $idProduk) {
                $message = "Error: Produk dengan ID " . htmlspecialchars($idProduk) . " sudah ada. Penambahan dibatalkan.";
                return; // batal tambah produk
            }
        }

        // tambahkan produk baru ke session
        $produkBaru = new ProdukElektronik($idProduk, $namaProduk, $kategori, $stok, $harga, $gambar);
        $_SESSION['daftarProduk'][] = $produkBaru;
        $message = "Produk berhasil ditambahkan.";
    }
}

// Fungsi untuk menghapus produk ===
function hapusData()
{
    global $message;
    if (isset($_GET['action']) && $_GET['action'] == 'hapus' && isset($_GET['id'])) {
        $idHapus = $_GET['id'];
        $found = false;

        foreach ($_SESSION['daftarProduk'] as $index => $produk) {
            if ($produk->idProduk === $idHapus) {
                // jika ada gambar terkait, hapus juga dari folder
                if ($produk->gambar && file_exists(__DIR__ . '/' . $produk->gambar)) {
                    unlink(__DIR__ . '/' . $produk->gambar);
                }
                // hpus produk dari session
                array_splice($_SESSION['daftarProduk'], $index, 1);
                $message = "Produk berhasil dihapus.";
                $found = true;
            }
        }

        if (!$found) {
            $message = "Produk dengan ID $idHapus tidak ditemukan.";
        }
    }
}

// ungsfi untuk mengupdate data produk ===
function updateData()
{
    global $message;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $idUpdate = $_POST['idProduk'];
        $found = false;

        foreach ($_SESSION['daftarProduk'] as $index => $produk) {
            if ($produk->idProduk === $idUpdate) {
                // update data produk
                $_SESSION['daftarProduk'][$index]->namaProduk = $_POST['namaProduk'];
                $_SESSION['daftarProduk'][$index]->kategori = $_POST['kategori'];
                $_SESSION['daftarProduk'][$index]->stok = (int) $_POST['stok'];
                $_SESSION['daftarProduk'][$index]->harga = (int) $_POST['harga'];

                // Uudate gambar (kalau ada upload baru)
                $gambarBaru = uploadGambar('gambar', $produk->gambar);
                $_SESSION['daftarProduk'][$index]->gambar = $gambarBaru;

                $message = "Produk berhasil diupdate.";
                $found = true;
            }
        }

        if (!$found) {
            $message = "Error: Produk tidak ditemukan.";
        }
    }
}

// eksekusi fungsi sesuai action 
tambahData();
hapusData();
updateData();

//ambil data produk yang akan diedit (jika ada)
$produkToUpdate = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $idEdit = $_GET['id'];
    foreach ($_SESSION['daftarProduk'] as $produk) {
        if ($produk->idProduk === $idEdit) {
            $produkToUpdate = $produk;
            break;
        }
    }
}
