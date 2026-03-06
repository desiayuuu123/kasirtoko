<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    \App\Models\User::create([
        'nama' => 'Pak Patah',
        'username' => 'admin',
        'role' => 'admin',
        'password' => bcrypt('password'),
    ]);

    \App\Models\User::create([
        'nama' => 'Pak Aldhi',
        'username' => 'admin1',
        'role' => 'admin',
        'password' => bcrypt('password'),
    ]);

    \App\Models\User::create([
        'nama' => 'Desi',
        'username' => 'admin2',
        'role' => 'admin',
        'password' => bcrypt('password'),
    ]);

    \App\Models\User::create([
        'nama' => 'Bunga',
        'username' => 'petugas',
        'role' => 'petugas',
        'password' => bcrypt('password'),
    ]);

    \App\Models\User::create([
        'nama' => 'Aulia',
        'username' => 'petugas1',
        'role' => 'petugas',
        'password' => bcrypt('password'),
    ]);

    \App\Models\User::create([
        'nama' => 'Wanda',
        'username' => 'petugas2',
        'role' => 'petugas',
        'password' => bcrypt('password'),
    ]);

    \App\Models\Pelanggan::create([
        'nama' => 'Nabila',
        'alamat' => 'Sindangwangi',
        'nomor_tlp' => '082288877766'
    ]);

    \App\Models\Pelanggan::create([
        'nama' => 'Zahra',
        'alamat' => 'Tunggilis',
        'nomor_tlp' => '082288866677'
    ]);

    \App\Models\Pelanggan::create([
        'nama' => 'Dina',
        'alamat' => 'Padaherang',
        'nomor_tlp' => '085721653545'
    ]);

    \App\Models\Pelanggan::create([
        'nama' => 'Satrio',
        'alamat' => 'Kalipucang',
        'nomor_tlp' => '085721653553'
    ]);

    \App\Models\Pelanggan::create([
        'nama' => 'Zaidan',
        'alamat' => 'Banjarsari',
        'nomor_tlp' => '085721653598'
    ]);

    \App\Models\Kategori::create([
        'nama_kategori' => 'Kesehatan',
    ]);

     \App\Models\Kategori::create([
        'nama_kategori' => 'Kecantikan',
    ]);

     \App\Models\Kategori::create([
        'nama_kategori' => 'Elektronik',
    ]);

    \App\Models\Produk::create([
            'kategori_id'=> 1,
            'kode_produk'=>'1001',
            'nama_produk'=>'GOLI Ashwagandha Gummies ',
            'harga_produk' => 500000,    // Harga beli/modal
            'harga_jual' => 600000,      // Harga jual sebelum diskon
            'diskon' => 10,             // Tidak ada diskon
            'harga' => 540000,          // Harga final (5000 - 0% = 5000)
        ]);

     \App\Models\Produk::create([
            'kategori_id'=> 1,
            'kode_produk'=>'1002',
            'nama_produk'=>'Habbatussauda Kurma Ajwa',
            'harga_produk' => 154000,    // Harga beli/modal
            'harga_jual' => 160000,      // Harga jual sebelum diskon
            'diskon' => 0,             // Tidak ada diskon
            'harga' => 160000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 1,
            'kode_produk'=>'1003',
            'nama_produk'=>'Habbasyifa Minyak Habbatussauda',
             'harga_produk' => 158000,    // Harga beli/modal
            'harga_jual' => 160000,      // Harga jual sebelum diskon
            'diskon' => 0,             // Tidak ada diskon
            'harga' => 160000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 1,
            'kode_produk'=>'1004',
            'nama_produk'=>'Strong Wakamoto sachet',
            'harga_produk' => 343000,    // Harga beli/modal
            'harga_jual' => 350000,      // Harga jual sebelum diskon
            'diskon' => 0,             // Tidak ada diskon
            'harga' => 350000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 1,
            'kode_produk'=>'1005',
            'nama_produk'=>'Obat Antibiotik OTC',
             'harga_produk' => 700000,    // Harga beli/modal
            'harga_jual' => 800000,      // Harga jual sebelum diskon
            'diskon' => 10,             // Tidak ada diskon
            'harga' => 720000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 2,
            'kode_produk'=>'1006',
            'nama_produk'=>'Dior Cream Blush',
             'harga_produk' => 550000,    // Harga beli/modal
            'harga_jual' => 555000,      // Harga jual sebelum diskon
            'diskon' => 0,             // Tidak ada diskon
            'harga' => 555000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 2,
            'kode_produk'=>'1007',
            'nama_produk'=>'Dior Forever Skin Correct Concealer',
            'harga_produk' => 850000,    // Harga beli/modal
            'harga_jual' => 950000,      // Harga jual sebelum diskon
            'diskon' => 10,             // Tidak ada diskon
            'harga' => 855000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 2,
            'kode_produk'=>'1008',
            'nama_produk'=>'antibioNars Luxury EyeshadObattik OTow Palette',
            'harga_produk' => 700000,    // Harga beli/modal
            'harga_jual' => 750000,      // Harga jual sebelum diskon
            'diskon' => 5,             // Tidak ada diskon
            'harga' => 712500,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 2,
            'kode_produk'=>'1009',
            'nama_produk'=>'Charlotte Tilbury compact powder',
             'harga_produk' => 710000,    // Harga beli/modal
            'harga_jual' => 800000,      // Harga jual sebelum diskon
            'diskon' => 10,             // Tidak ada diskon
            'harga' => 720000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 2,
            'kode_produk'=>'1010',
            'nama_produk'=>'Charlotte Tilbury browcara',
             'harga_produk' => 700000,    // Harga beli/modal
            'harga_jual' => 750000,      // Harga jual sebelum diskon
            'diskon' => 5,             // Tidak ada diskon
            'harga' => 712500,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 3,
            'kode_produk'=>'1011',
            'nama_produk'=>'Headset Logitech H390 (USB)',
             'harga_produk' => 650000,    // Harga beli/modal
            'harga_jual' => 660000,      // Harga jual sebelum diskon
            'diskon' => 0,             // Tidak ada diskon
            'harga' => 660000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 3,
            'kode_produk'=>'1012',
            'nama_produk'=>'Webcam Logitech C270 HD',
             'harga_produk' => 400000,    // Harga beli/modal
            'harga_jual' => 420000,      // Harga jual sebelum diskon
            'diskon' => 0,             // Tidak ada diskon
            'harga' => 420000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 3,
            'kode_produk'=>'1013',
            'nama_produk'=>'Rice Cooker Philips HD3119 2L',
             'harga_produk' => 600000,    // Harga beli/modal
            'harga_jual' => 700000,      // Harga jual sebelum diskon
            'diskon' => 5,             // Tidak ada diskon
            'harga' => 665000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 3,
            'kode_produk'=>'1014',
            'nama_produk'=>'JBL Go 3 Portable Bluetooth Speaker',
             'harga_produk' => 400000,    // Harga beli/modal
            'harga_jual' => 420000,      // Harga jual sebelum diskon
            'diskon' => 0,             // Tidak ada diskon
            'harga' => 420000,           // Harga final (5000 - 0% = 5000)
        ]);

        \App\Models\Produk::create([
            'kategori_id'=> 3,
            'kode_produk'=>'1015',
            'nama_produk'=>'Setrika Uap Philips GC1750',
             'harga_produk' => 450000,    // Harga beli/modal
            'harga_jual' => 455000,      // Harga jual sebelum diskon
            'diskon' => 0,             // Tidak ada diskon
            'harga' => 455000,           // Harga final (5000 - 0% = 5000)
        ]);

    \App\Models\Stok::create([
        'produk_id' => 1,
        'nama_suplier' => 'PT GOLI Ashwagandha Gummies ',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 2,
        'nama_suplier' => 'PT Habbatussauda Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 3,
        'nama_suplier' => 'PT Habbatussauda Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 4,
        'nama_suplier' => 'PT Wakamoto Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 5,
        'nama_suplier' => 'PT OTC Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 6,
        'nama_suplier' => 'Dior Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 7,
        'nama_suplier' => 'Dior Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 8,
        'nama_suplier' => 'Luxury Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 9,
        'nama_suplier' => 'Charlotte Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 10,
        'nama_suplier' => 'Charlotte Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 11,
        'nama_suplier' => 'Logitech Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 12,
        'nama_suplier' => 'Logitech Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 13,
        'nama_suplier' => 'Philips Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 14,
        'nama_suplier' => 'PT JBL Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Stok::create([
        'produk_id' => 15,
        'nama_suplier' => 'Philips Indonesia',
        'jumlah' => 100,
        'tanggal' => date('Y-m-d', strtotime('-1 week'))
    ]);

    \App\Models\Produk::where('id', 1)->update([
        'stok' => 1000,
    ]);

    \App\Models\Produk::where('id', 2)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 3)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 4)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 5)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 6)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 7)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 8)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 9)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 10)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 11)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 12)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 13)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 14)->update([
        'stok' => 100,
    ]);

    \App\Models\Produk::where('id', 15)->update([
        'stok' => 100,
    ]);

   }
}
