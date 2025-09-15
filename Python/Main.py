from ProdukElektronik import ProdukElektronik

def main():
    # loop utama program
    while True:
        # tampilkan menu
        print("\n=== Menu Produk Elektronik ===")
        print("1. Tambah Produk")
        print("2. Tampilkan Produk")
        print("3. Cari Produk")
        print("4. Update Produk")
        print("5. Hapus Produk")
        print("0. Keluar")
        
        try:
            # input pilihan menu
            pilihan = int(input("Pilih: "))
            
            # eksekusi berdasarkan pilihan
            if pilihan == 1:
                ProdukElektronik.tambah_data()
            elif pilihan == 2:
                ProdukElektronik.tampilkan_data()
            elif pilihan == 3:
                ProdukElektronik.cari_data()
            elif pilihan == 4:
                ProdukElektronik.update_data()
            elif pilihan == 5:
                ProdukElektronik.hapus_data()
            elif pilihan == 0:
                print("Program selesai.")
                break
            else:
                print("Pilihan tidak valid, silakan coba lagi.")
        except ValueError:
            # jika input bukan angka
            print("Input tidak valid. Masukkan angka.")

# entry point
if __name__ == "__main__":
    main()
