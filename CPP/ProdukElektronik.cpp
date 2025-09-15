#include <iostream>
#include <string>
#include <vector>
#include <limits>

using namespace std;

class ProdukElektronik {
    private:
        //menyiapkan atribut yang dipakai 
        string idProduk;
        string namaProduk;
        string kategori;
        int stok;
        int harga;

        //static vector untuk menyimpan semua produk
        static vector<ProdukElektronik> daftarProduk;

    public:

    //membuat kontruktor untuk inisisasi
    ProdukElektronik(string idProduk, string namaProduk, string kategori, int stok, int harga) {
        this->idProduk = idProduk;
        this->namaProduk = namaProduk;
        this->kategori = kategori;
        this->stok = stok;
        this->harga = harga;
    }

    //membuat getter atribut
    string getIdProduk() {
        return idProduk;
    }
    string getNamaProduk() {
        return namaProduk;
    }
    string getKategori() {
        return kategori;
    }
    int getStok() {
        return stok;
    }
    double getHarga() {
        return harga;
    }

    //membuat setter atribut
    void setIdProduk(string id) {
        this->idProduk = id;
    }
    void setNamaProduk(string nama) {
        this->namaProduk = nama;
    }
    void setKategori(string kategori) {
        this->kategori = kategori;
    }
    void setStok(int stok) {
        this->stok = stok;
    }
    void setHarga(int harga) {
        this->harga = harga;
    }

    //membuat method untuk menampilkan produk
    void tampilkan()
    {
        //langsung menampilkan sesuai dengan object yang dipilih
        cout << "ID: " << idProduk << endl;
        cout << "Nama Produk: " << namaProduk << endl;
        cout << "Kategori: " << kategori << endl;
        cout << "Stok: " << stok << endl;
        cout << "Harga: Rp. " << harga << endl;
    }

    //membuat method untuk tambah data
    static void tambahData()
    {
        string id, nama, kategori;
        int stok, harga; //menyiapkan var temp
        
        cout << "Masukkan ID Produk: ";
        cin >> id; //memasukkan id produk 

        //mencari id produk dengan menulusuri semua produk lalu dibandingkan
        for (const auto &produk : daftarProduk)
        {
            if (produk.idProduk == id)
            {
                cout << "Error: Produk dengan ID " << id << " sudah ada. Penambahan dibatalkan.\n";
                return; 
            }
        }

        //proses memasukkkan data
        cin.ignore(numeric_limits<streamsize>::max(), '\n'); //agar bisa memasukkan string dengan spasi jadi ignore whitespace
        cout << "Masukkan Nama Produk: ";
        getline(cin, nama); //supaya bisa dengan spasi
        cout << "Masukkan Kategori: ";
        cin >> kategori;
        cout << "Masukkan Stok: ";
        cin >> stok;
        cout << "Masukkan Harga: ";
        cin >> harga;

        daftarProduk.push_back(ProdukElektronik(id, nama, kategori, stok, harga)); //dimasukkan ke dalam vector
        cout << "Produk berhasil ditambahkan.\n";
    }

    //membuat method untuk menampilkan semua produk
    static void tampilkanData()
    {
        if (daftarProduk.empty())
        {
            cout << "Data produk kosong.\n";
        }
        for (ProdukElektronik &p : daftarProduk) //perulangan sejumlah jumlah produk
        {
            p.tampilkan();
            cout << endl;
        }
    }

    //membuat method untuk mencari data
    static void cariData()
    {
        string id;
        cout << "Masukkan ID yang dicari: ";
        cin >> id;

        //setelah id dimasukkan lalu dibandingkan apakah ada yang cocok atau tidak
        for (ProdukElektronik &p : daftarProduk)
        {
            if (p.getIdProduk() == id)
            {
                p.tampilkan();//kalau ada tampilkan
                return;
            }
        }
        cout << "Produk tidak ditemukan.\n";//jika tidak ada
    }

    //membuat method untuk mengupdate data
    static void updateData()
    {
        string id;
        cout << "Masukkan ID yang ingin diupdate: ";
        cin >> id;

        for (ProdukElektronik &p : daftarProduk)
        {
            if (p.getIdProduk() == id) //jika id sesuai maka
            {
                int pilihan; //akan ada pilihan atribut apa yang akan diubah sehingga tidak langsung merubah semuanya
                do
                {
                    cout << "\n=== Menu Update Produk ===\n";
                    cout << "1. Update Nama\n";
                    cout << "2. Update Kategori\n";
                    cout << "3. Update Stok\n";
                    cout << "4. Update Harga\n";
                    cout << "5. Update Semua Sekaligus\n";
                    cout << "0. Selesai\n";
                    cout << "Pilih: ";
                    cin >> pilihan;

                    switch (pilihan)
                    {
                    case 1:
                    {
                        string nama;
                        cout << "Masukkan Nama baru: ";
                        cin >> nama;
                        p.setNamaProduk(nama);
                        cout << "Nama berhasil diupdate.\n";
                        break;
                    }
                    case 2:
                    {
                        string kategori;
                        cout << "Masukkan Kategori baru: ";
                        cin >> kategori;
                        p.setKategori(kategori);
                        cout << "Kategori berhasil diupdate.\n";
                        break;
                    }
                    case 3:
                    {
                        int stok;
                        cout << "Masukkan Stok baru: ";
                        cin >> stok;
                        p.setStok(stok);
                        cout << "Stok berhasil diupdate.\n";
                        break;
                    }
                    case 4:
                    {
                        int harga;
                        cout << "Masukkan Harga baru: ";
                        cin >> harga;
                        p.setHarga(harga);
                        cout << "Harga berhasil diupdate.\n";
                        break;
                    }
                    case 5:
                    {
                        string nama, kategori;
                        int stok, harga;
                        cout << "Masukkan Nama baru: ";
                        cin >> nama;
                        cout << "Masukkan Kategori baru: ";
                        cin >> kategori;
                        cout << "Masukkan Stok baru: ";
                        cin >> stok;
                        cout << "Masukkan Harga baru: ";
                        cin >> harga;
                        p.setNamaProduk(nama);
                        p.setKategori(kategori);
                        p.setStok(stok);
                        p.setHarga(harga);
                        cout << "Semua data berhasil diupdate.\n";
                        break;
                    }
                    case 0:
                        cout << "Selesai update.\n";
                        break;
                    default:
                        cout << "Pilihan tidak valid.\n";
                    }
                } while (pilihan != 0);

                return;
            }
        }
        cout << "Produk tidak ditemukan.\n"; //jika produk tidak ada
    }

    //membuat method untuk hapus data
    static void hapusData()
    {
        string id;
        cout << "Masukkan ID yang ingin dihapus: ";
        cin >> id; //dicari lewat id yang ingin dihapus

        for (int i = 0; i < daftarProduk.size(); i++)
        {
            if (daftarProduk[i].getIdProduk() == id)
            {
                daftarProduk.erase(daftarProduk.begin() + i); //jika ketemu akan di erase dari vector
                cout << "Produk berhasil dihapus.\n";
                return;
            }
        }
        cout << "Produk tidak ditemukan.\n";
    }

    //membuat destruktor
    ~ProdukElektronik() {
    }
};
