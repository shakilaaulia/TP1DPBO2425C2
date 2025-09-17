# TP1DPBO2425C2
## JANJI
Saya Shakila Aulia dengan NIM 2403086 mengerjakan Tugas Praktikum 1 dalam mata kuliah Desain dan Pemograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

---
## DESAIN DAN KODE FLOW
**Desain**

Untuk desain sendiri menggunakan satu class yaitu ProdukElektronik, yang memiliki atribut dan method:
Atribut
- idProduk
- namaProduk
- kategori
- stok
- harga
- gambar (khusus versi web PHP)

  Method
  - tambahData() = tambah produk baru yang idnya belum terdaftar
  - tampilkanData() = menampilkan semua produk
  - cariData() = cari produk berdasarkan ID
  - updateData() = update data produk berdasarkan ID (bisa pilih per atribut atau semua)
  - hapusData() = hapus produk berdasarkan ID
 
  **Kode Flow**
  
  1. C++
     - Program mulai dari Main.cpp untuk tampilkan menu
     - User pilih menu (Tambah, Tampil, Cari, Update, Hapus, Keluar) memakai switch
     - Input pakai cin untuk string panjang pakai getLine(), output pakai cout
     - Ketika sudah memilih aksi otomatis Method di class akan dieksekusi sesuai pilihan
     -  Semua data produk disimpan dalam static vector di class ProdukElektronik
       
  3. JAVA
     - Program mulai dari Main.java
     - Menu ditampikan menggunakan switch user memilih aksi dengan input Scaner
     -  Sama kayak C++, semua CRUD (Create, Read, Update, Delete) dikerjain lewat method static, jadi setelah dipilih aksinya akan langsung memanggil method
     - Data produk disimpan dalam ArrayList static di class ProdukElektronik

  5. PYTHON
     - Program mulai dari main.py
     - Menu ditampilkan pakai while True loop jadi untuk pilihan menggunakan if else
     - Input pakai input(), output pakai print()
     - Setelah panggil method data disimpan di List Static
       
  7. PHP
     - Semua data produk disimpan dalam $_SESSION['daftarProduk']
     - File ProdukElektronik.php berisi class + function CRUD
     - File index.php berupa tampilan web (Bootstrap, form tambah/edit, tabel daftar produk)
     - Untuk menambah produk isi form dan upload gambar (gambar disimpan di folder gambar/)
     - Untuk edit produk form masih terisi data lama lalu pilih yang akan diupdate bisa juga menganti gambar
     - Untuk hapus produk data dan gambar akan terhapus
     - Fitur pencarian tinggal masukan apa yang mau dicari lalu akan langsung menampilkan

*Penjelasan detail tiap methodnya dijelaskan dalam komentar di kode program

---
## DOKUMENTASI
Tampilan Output CLI (CPP,JAVA,PYTHON)

![Tampilan Output CLI (CPP,JAVA,PYTHON)](Dokumentasi/SS-CLI.png)

Tampilan Output WEBSITE (PHP)

![Tampilan Output WEBSITE (PHP)](Dokumentasi/SS-PHP1.png) ![Tampilan Output WEBSITE (PHP)](Dokumentasi/SS-PHP2.png)

*Dokumentasi lebih lanjut berupa screen record ada dalam folder dokumentasi
