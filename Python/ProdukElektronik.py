class ProdukElektronik:
    # Static list untuk menyimpan semua produk
    daftar_produk = []

    def __init__(self, id_produk, nama_produk, kategori, stok, harga):
        # atribut produk
        self.id_produk = id_produk
        self.nama_produk = nama_produk
        self.kategori = kategori
        self.stok = stok
        self.harga = harga

    # getter untuk setiap atribut
    def get_id_produk(self):
        return self.id_produk

    def get_nama_produk(self):
        return self.nama_produk

    def get_kategori(self):
        return self.kategori

    def get_stok(self):
        return self.stok

    def get_harga(self):
        return self.harga

    # setter untuk setiap atribut
    def set_id_produk(self, id):
        self.id_produk = id

    def set_nama_produk(self, nama):
        self.nama_produk = nama

    def set_kategori(self, kategori):
        self.kategori = kategori

    def set_stok(self, stok):
        self.stok = stok

    def set_harga(self, harga):
        self.harga = harga

    # method untuk menampilkan detail produk
    def tampilkan(self):
        print(f"ID: {self.id_produk}")
        print(f"Nama Produk: {self.nama_produk}")
        print(f"Kategori: {self.kategori}")
        print(f"Stok: {self.stok}")
        print(f"Harga: Rp. {self.harga}")

    @staticmethod
    def tambah_data():
        # input id produk
        id_produk = input("Masukkan ID Produk: ")

        # periksa apakah ID sudah ada
        for p in ProdukElektronik.daftar_produk:
            if p.get_id_produk() == id_produk:
                print(f"Error: Produk dengan ID {id_produk} sudah ada. Penambahan dibatalkan.")
                return # keluar dari method

        # input data produk baru
        nama_produk = input("Masukkan Nama Produk: ")
        kategori = input("Masukkan Kategori: ")
        stok = int(input("Masukkan Stok: "))
        harga = int(input("Masukkan Harga: "))

        # simpan ke list static
        ProdukElektronik.daftar_produk.append(ProdukElektronik(id_produk, nama_produk, kategori, stok, harga))
        print("Produk berhasil ditambahkan.")

    @staticmethod
    def tampilkan_data():
        # jika list kosong
        if not ProdukElektronik.daftar_produk:
            print("Data produk kosong.")
            return
        # tampilkan semua produk
        for p in ProdukElektronik.daftar_produk:
            p.tampilkan()
            print()

    @staticmethod
    def cari_data():
        # input id yang dicari
        id_cari = input("Masukkan ID yang dicari: ")

        # cari berdasarkan id
        for p in ProdukElektronik.daftar_produk:
            if p.get_id_produk() == id_cari:
                p.tampilkan()
                return
        print("Produk tidak ditemukan.")

    @staticmethod
    def update_data():
        # input id yang ingin diupdate
        id_update = input("Masukkan ID yang ingin diupdate: ")

        for p in ProdukElektronik.daftar_produk:
            if p.get_id_produk() == id_update:
                # menu update
                while True:
                    print("\n=== Menu Update Produk ===")
                    print("1. Update Nama")
                    print("2. Update Kategori")
                    print("3. Update Stok")
                    print("4. Update Harga")
                    print("5. Update Semua Sekaligus")
                    print("0. Selesai")
                    pilihan = input("Pilih: ")

                    # update sesuai pilihan
                    if pilihan == "1":
                        nama_baru = input("Masukkan Nama baru: ")
                        p.set_nama_produk(nama_baru)
                        print("Nama berhasil diupdate.")
                    elif pilihan == "2":
                        kategori_baru = input("Masukkan Kategori baru: ")
                        p.set_kategori(kategori_baru)
                        print("Kategori berhasil diupdate.")
                    elif pilihan == "3":
                        stok_baru = int(input("Masukkan Stok baru: "))
                        p.set_stok(stok_baru)
                        print("Stok berhasil diupdate.")
                    elif pilihan == "4":
                        harga_baru = int(input("Masukkan Harga baru: "))
                        p.set_harga(harga_baru)
                        print("Harga berhasil diupdate.")
                    elif pilihan == "5":
                        nama_baru = input("Masukkan Nama baru: ")
                        kategori_baru = input("Masukkan Kategori baru: ")
                        stok_baru = int(input("Masukkan Stok baru: "))
                        harga_baru = int(input("Masukkan Harga baru: "))
                        p.set_nama_produk(nama_baru)
                        p.set_kategori(kategori_baru)
                        p.set_stok(stok_baru)
                        p.set_harga(harga_baru)
                        print("Semua data berhasil diupdate.")
                    elif pilihan == "0":
                        print("Selesai update.")
                        break
                    else:
                        print("Pilihan tidak valid.")
                return
        print("Produk tidak ditemukan.")

    @staticmethod
    def hapus_data():
        # input id yang ingin dihapus
        id_hapus = input("Masukkan ID yang ingin dihapus: ")

        # cari produk sesuai id lalu hapus
        for i, p in enumerate(ProdukElektronik.daftar_produk):
            if p.get_id_produk() == id_hapus:
                ProdukElektronik.daftar_produk.pop(i)
                print("Produk berhasil dihapus.")
                return
        print("Produk tidak ditemukan.")
