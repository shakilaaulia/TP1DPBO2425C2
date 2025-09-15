import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class ProdukElektronik {
    //menyiapkan atribut yang dipakai
    private String idProduk;
    private String namaProduk;
    private String kategori;
    private int stok;
    private int harga;

    //static list untuk menyimpan semua produk 
    private static List<ProdukElektronik> daftarProduk = new ArrayList<>();

    //konstruktor untuk inisialisasi data produk
    public ProdukElektronik(String idProduk, String namaProduk, String kategori, int stok, int harga) {
        this.idProduk = idProduk;
        this.namaProduk = namaProduk;
        this.kategori = kategori;
        this.stok = stok;
        this.harga = harga;
    }

    //getter untuk mengambil nilai atribut
    public String getIdProduk() {
        return idProduk;
    }
    public String getNamaProduk() {
        return namaProduk;
    }
    public String getKategori() {
        return kategori;
    }
    public int getStok() {
        return stok;
    }
    public double getHarga() {
        return harga;
    }

    //setter untuk mengubah nilai atribut
    public void setIdProduk(String id) {
        this.idProduk = id;
    }
    public void setNamaProduk(String nama) {
        this.namaProduk = nama;
    }
    public void setKategori(String kategori) {
        this.kategori = kategori;
    }
    public void setStok(int stok) {
        this.stok = stok;
    }
    public void setHarga(int harga) {
        this.harga = harga;
    }

    //method untuk menampilkan detail produk
    public void tampilkan() {
        System.out.println("ID: " + this.idProduk);
        System.out.println("Nama Produk: " + this.namaProduk);
        System.out.println("Kategori: " + this.kategori);
        System.out.println("Stok: " + this.stok);
        System.out.println("Harga: Rp. " + this.harga);
    }

    //method untuk menambahkan produk baru
    public static void tambahData(Scanner input) {
        System.out.print("Masukkan ID Produk: ");
        String id = input.next();

        //cek apakah ID produk sudah ada
        for (ProdukElektronik p : daftarProduk) {
            if (p.getIdProduk().equals(id)) {
                System.out.println("Error: Produk dengan ID " + id + " sudah ada. Penambahan dibatalkan.");
                return; // keluar dari method
            }
        }

        //input data produk baru
        input.nextLine(); 
        System.out.print("Masukkan Nama Produk: ");
        String nama = input.nextLine();
        System.out.print("Masukkan Kategori: ");
        String kategori = input.nextLine();
        System.out.print("Masukkan Stok: ");
        int stok = input.nextInt();
        System.out.print("Masukkan Harga: ");
        int harga = input.nextInt();

        //simpan ke list
        daftarProduk.add(new ProdukElektronik(id, nama, kategori, stok, harga));
        System.out.println("Produk berhasil ditambahkan.");
    }

    //method untuk menampilkan semua produk
    public static void tampilkanData() {
        if (daftarProduk.isEmpty()) {
            System.out.println("Data produk kosong.");
            return;
        }
        for (ProdukElektronik p : daftarProduk) {
            p.tampilkan(); //ditampilkan sebanyak jumlah produk
            System.out.println();
        }
    }

    //method untuk mencari produk berdasarkan ID
    public static void cariData(Scanner input) {
        System.out.print("Masukkan ID yang dicari: ");
        String id = input.next();

        //cek apakah ada produk dengan ID yang sesuai
        for (ProdukElektronik p : daftarProduk) {
            if (p.getIdProduk().equals(id)) {
                p.tampilkan(); //tampilkan produk jika ditemukan
                return;
            }
        }
        System.out.println("Produk tidak ditemukan.");
    }

    //method untuk mengupdate data produk
    public static void updateData(Scanner input) {
        System.out.print("Masukkan ID yang ingin diupdate: ");
        String id = input.next();
        input.nextLine(); 

        //cari produk sesuai ID
        for (ProdukElektronik p : daftarProduk) {
            if (p.getIdProduk().equals(id)) {
                int pilihan;
                do {
                    //menu pilihan update disesuaikan dengan pilihn atribut
                    System.out.println("\n=== Menu Update Produk ===");
                    System.out.println("1. Update Nama");
                    System.out.println("2. Update Kategori");
                    System.out.println("3. Update Stok");
                    System.out.println("4. Update Harga");
                    System.out.println("5. Update Semua Sekaligus");
                    System.out.println("0. Selesai");
                    System.out.print("Pilih: ");
                    pilihan = input.nextInt();
                    input.nextLine(); 

                    switch (pilihan) {
                        case 1:
                            System.out.print("Masukkan Nama baru: ");
                            String nama = input.nextLine();
                            p.setNamaProduk(nama);
                            System.out.println("Nama berhasil diupdate.");
                            break;
                        case 2:
                            System.out.print("Masukkan Kategori baru: ");
                            String kategori = input.nextLine();
                            p.setKategori(kategori);
                            System.out.println("Kategori berhasil diupdate.");
                            break;
                        case 3:
                            System.out.print("Masukkan Stok baru: ");
                            int stok = input.nextInt();
                            p.setStok(stok);
                            System.out.println("Stok berhasil diupdate.");
                            break;
                        case 4:
                            System.out.print("Masukkan Harga baru: ");
                            int harga = input.nextInt();
                            p.setHarga(harga);
                            System.out.println("Harga berhasil diupdate.");
                            break;
                        case 5:
                            //update semua atribut sekaligus
                            System.out.print("Masukkan Nama baru: ");
                            String namaBaru = input.nextLine();
                            System.out.print("Masukkan Kategori baru: ");
                            String kategoriBaru = input.nextLine();
                            System.out.print("Masukkan Stok baru: ");
                            int stokBaru = input.nextInt();
                            System.out.print("Masukkan Harga baru: ");
                            int hargaBaru = input.nextInt();

                            p.setNamaProduk(namaBaru);
                            p.setKategori(kategoriBaru);
                            p.setStok(stokBaru);
                            p.setHarga(hargaBaru);
                            System.out.println("Semua data berhasil diupdate.");
                            break;
                        case 0:
                            System.out.println("Selesai update.");
                            break;
                        default:
                            System.out.println("Pilihan tidak valid.");
                    }
                } while (pilihan != 0);
                return;
            }
        }
        System.out.println("Produk tidak ditemukan.");
    }

    //method untuk menghapus data produk
    public static void hapusData(Scanner input) {
        System.out.print("Masukkan ID yang ingin dihapus: ");
        String id = input.next();

        //cari produk lalu hapus jika ada
        for (int i = 0; i < daftarProduk.size(); i++) {
            if (daftarProduk.get(i).getIdProduk().equals(id)) {
                daftarProduk.remove(i); //menggunakan remove
                System.out.println("Produk berhasil dihapus.");
                return;
            }
        }
        System.out.println("Produk tidak ditemukan.");
    }
}
