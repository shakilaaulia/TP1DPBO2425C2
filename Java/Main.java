import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        //membuat scanner untuk input dari user
        Scanner input = new Scanner(System.in);
        int pilihan; //menyimpan pilihan menu

        //perulangan menu agar bisa dipilih berkali-kali
        do {
            System.out.println("\n=== Menu Produk Elektronik ===");
            System.out.println("1. Tambah Produk");
            System.out.println("2. Tampilkan Produk");
            System.out.println("3. Cari Produk");
            System.out.println("4. Update Produk");
            System.out.println("5. Hapus Produk");
            System.out.println("0. Keluar");
            System.out.print("Pilih: ");

            pilihan = input.nextInt(); //membaca pilihan user

            //memilih menu sesuai input user
            switch (pilihan) {
                case 1:
                    ProdukElektronik.tambahData(input); //memanggil method tambah data
                    break;
                case 2:
                    ProdukElektronik.tampilkanData(); //memanggil method tampilkan semua data
                    break;
                case 3:
                    ProdukElektronik.cariData(input); //memanggil method cari produk
                    break;
                case 4:
                    ProdukElektronik.updateData(input); //memanggil method update produk
                    break;
                case 5:
                    ProdukElektronik.hapusData(input); //memanggil method hapus produk
                    break;
            }
        } while (pilihan != 0); //akan berhenti jika memilih 0

        //program selesai
        System.out.println("Program selesai.");
        input.close(); //menutup scanner
    }
}
