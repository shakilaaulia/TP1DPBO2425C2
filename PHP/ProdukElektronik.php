<?php
session_start();

class ProdukElektronik
{
    // atribut private
    private $idProduk;
    private $namaProduk;
    private $kategori;
    private $stok;
    private $harga;
    private $gambar;

    // constructor
    public function __construct($id, $nama, $kategori, $stok, $harga, $gambar)
    {
        $this->idProduk = $id;
        $this->namaProduk = $nama;
        $this->kategori = $kategori;
        $this->stok = $stok;
        $this->harga = $harga;
        $this->gambar = $gambar;
    }

    // getter
    public function getIdProduk()
    {
        return $this->idProduk;
    }
    public function getNamaProduk()
    {
        return $this->namaProduk;
    }
    public function getKategori()
    {
        return $this->kategori;
    }
    public function getStok()
    {
        return $this->stok;
    }
    public function getHarga()
    {
        return $this->harga;
    }
    public function getGambar()
    {
        return $this->gambar;
    }

    // setter
    public function setNamaProduk($nama)
    {
        $this->namaProduk = $nama;
    }
    public function setKategori($kategori)
    {
        $this->kategori = $kategori;
    }
    public function setStok($stok)
    {
        $this->stok = $stok;
    }
    public function setHarga($harga)
    {
        $this->harga = $harga;
    }
    public function setGambar($gambar)
    {
        $this->gambar = $gambar;
    }

    // function untuk crud
    public static function tambahProduk($produk)
    {
        $_SESSION['daftarProduk'][] = $produk; //memasukkan produk ke session
    }

    public static function getProdukById($id)
    {
        foreach ($_SESSION['daftarProduk'] as $p) { //mencari id di semua produk
            if ($p->getIdProduk() === $id) { //jika ketemu
                return $p; //maka return produknya
            }
        }
        return null;
    }

    public static function hapusProduk($id)
    {
        foreach ($_SESSION['daftarProduk'] as $i => $p) {
            if ($p->getIdProduk() === $id) { //setelah dicari maka
                unset($_SESSION['daftarProduk'][$i]); //unset produk dari session
                $_SESSION['daftarProduk'] = array_values($_SESSION['daftarProduk']);
                return true;
            }
        }
        return false;
    }

    public static function cariId($id)
    {
        foreach ($_SESSION['daftarProduk'] as $p) {
            if ($p->getIdProduk() === $id) {
                return true; //mencari id apakah sudah ada atau belum
            }
        }
        return false;
    }

    //mencari produk berdasarkan keyword
    public static function cariProduk($keyword)
    {
        $hasil = [];
        foreach ($_SESSION['daftarProduk'] as $p) {
            if (
                stripos($p->getNamaProduk(), $keyword) !== false ||
                stripos($p->getKategori(), $keyword) !== false //kalau beda diset false
            ) {
                $hasil[] = $p; //kalau sama maka langsung return produknya
            }
        }
        return $hasil;
    }

    public function updateProduk($nama, $kategori, $stok, $harga, $gambar = null)
    {
        $this->setNamaProduk($nama);
        $this->setKategori($kategori);
        $this->setStok($stok);
        $this->setHarga($harga);
        if ($gambar) {
            $this->setGambar($gambar);
        }
        //set dengan data yang baru
    }
}
