<?php

namespace Database\Seeders;

use App\Imports\TransaksiImport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $jumlahTransaksi = 200;

        $jumlahPelanggan = 100;
        $daftarPelanggan = [];

        for ($i = 1; $i <= $jumlahPelanggan; $i++) {
            $daftarPelanggan[] = 'p' . $i;
        }

        $daftarProduk = ['a', 'b', 'c', 'd'];

        for ($i = 0; $i < $jumlahTransaksi; $i++) {
            $pelanggan = $daftarPelanggan[array_rand($daftarPelanggan)];

            // Mengambil sejumlah produk acak (antara 1 hingga 4 item)
            $jumlahProduk = rand(1, 4);
            $produkArray = [];

            // Menggunakan array asosiatif untuk memastikan produk yang unik
            $produkUnik = [];

            while (count($produkUnik) < $jumlahProduk) {
                $produk = $daftarProduk[array_rand($daftarProduk)];
                $produkUnik[$produk] = true;
            }

            // Menggabungkan produk unik menjadi satu string dengan tanda koma
            $produk = implode(',', array_keys($produkUnik));

            DB::table('transaksi')->insert([
                'pelanggan' => $pelanggan,
                'item' => $produk,
                'tanggal' => '2023-11-09'
            ]);
        }

        $jumlahTransaksi = 200;
        $jumlahPelanggan = 100;
        $daftarPelanggan = [];

        for ($i = 1; $i <= $jumlahPelanggan; $i++) {
            $daftarPelanggan[] = 'p' . $i;
        }

        $daftarProduk = ['a', 'b', 'c', 'd'];

        for ($i = 0; $i < $jumlahTransaksi; $i++) {
            $pelanggan = $daftarPelanggan[array_rand($daftarPelanggan)];

            // Memastikan 4 itemset unik dalam satu transaksi
            $produkUnik = [];
            while (count($produkUnik) < 4) {
                $produk = $daftarProduk[array_rand($daftarProduk)];
                if (!in_array($produk, $produkUnik)) {
                    $produkUnik[] = $produk;
                }
            }

            // Menggabungkan produk unik menjadi satu string dengan tanda koma
            $produk = implode(',', $produkUnik);

            DB::table('transaksi')->insert([
                'pelanggan' => $pelanggan,
                'item' => $produk,
                'tanggal' => '2023-11-09'
            ]);
        }
    }
}
