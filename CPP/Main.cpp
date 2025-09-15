#include <iostream>
#include <vector>
#include "ProdukElektronik.cpp" //menghubungkan dengan file ProdukElektronik
using namespace std;

//inisialisasi static vector daftarProduk dari class ProdukElektronik
vector<ProdukElektronik> ProdukElektronik::daftarProduk;

int main()
{
    int pilihan; //variabel untuk menyimpan pilihan menu
    do
    {
        //menampilkan menu utama
        cout << "\n=== Menu Produk Elektronik ===\n";
        cout << "1. Tambah Produk\n";
        cout << "2. Tampilkan Produk\n";
        cout << "3. Cari Produk\n";
        cout << "4. Update Produk\n";
        cout << "5. Hapus Produk\n";
        cout << "0. Keluar\n";
        cout << "Pilih: ";
        cin >> pilihan;

        //menentukan aksi sesuai pilihan
        switch (pilihan)
        {
        case 1:
            ProdukElektronik::tambahData(); //memanggil method tambah data
            break;
        case 2:
            ProdukElektronik::tampilkanData(); //memanggil method tampilkan semua data
            break;
        case 3:
            ProdukElektronik::cariData(); //memanggil method cari data
            break;
        case 4:
            ProdukElektronik::updateData(); //memanggil method update data
            break;
        case 5:
            ProdukElektronik::hapusData(); //memanggil method hapus data
            break;
        }
    } while (pilihan != 0); //akan terus berulang sampai memilih 0

    return 0; //program selesai
}
