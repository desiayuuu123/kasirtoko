<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;


class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.form');
    }
    public function harian(Request $request)
{
    $tanggal = $request->tanggal ?? date('Y-m-d');

    // Ambil semua penjualan di tanggal tsb
    $penjualan = \DB::table('penjualans')
        ->join('users', 'users.id', '=', 'penjualans.user_id')
        ->leftJoin('pelanggans', 'pelanggans.id', '=', 'penjualans.pelanggan_id')
        ->whereDate('penjualans.tanggal', $tanggal)
        ->select(
            'penjualans.id',
            'penjualans.nomor_transaksi',
            'penjualans.status',
            'penjualans.tanggal',
            'users.nama as nama_kasir',
            \DB::raw("COALESCE(pelanggans.nama, 'Pelanggan') as nama_pelanggan"),
            'penjualans.subtotal'
        )
        ->orderBy('penjualans.id')
        ->get();

    // Ambil detail barang tiap transaksi
    $detil = \DB::table('detil_penjualans')
        ->join('produks', 'produks.id', '=', 'detil_penjualans.produk_id')
        ->select('detil_penjualans.penjualan_id', 'produks.nama_produk as nama', 'detil_penjualans.jumlah')
        ->get()
        ->groupBy('penjualan_id');

   // Ambil transaksi selesai (berhasil)
$selesai = Penjualan::whereDate('tanggal', $tanggal)
            ->where('status', 'selesai');
$jumlah_berhasil = $selesai->count();
$total_berhasil = $selesai->sum('total');

// Ambil transaksi batal
$batal = Penjualan::whereDate('tanggal', $tanggal)
            ->where('status', 'batal');
$jumlah_batal = $batal->count();
$total_batal = $batal->sum('total');

// Produk terlaris hari itu
$produk_terlaris = DB::table('detil_penjualans')
    ->join('produks', 'produks.id', '=', 'detil_penjualans.produk_id')
    ->join('penjualans', 'penjualans.id', '=', 'detil_penjualans.penjualan_id')
    ->whereDate('penjualans.tanggal', $tanggal)
    ->where('penjualans.status', 'selesai') // hanya transaksi berhasil
    ->select(
        'produks.nama_produk',
        DB::raw('SUM(detil_penjualans.jumlah) as total_terjual')
    )
    ->groupBy('produks.nama_produk')
    ->orderByDesc('total_terjual')
    ->get();

    return view('laporan.harian', compact(
        'tanggal',
        'penjualan',
        'detil',
        'jumlah_berhasil',
        'total_berhasil',
        'jumlah_batal',
        'total_batal',
        'produk_terlaris'
    ));
}

    public function bulanan(Request $request)
{
    $penjualan = Penjualan::select(
            DB::raw("DATE_FORMAT(tanggal, '%d/%m/%Y') as tgl"),
            DB::raw("SUM(CASE WHEN status = 'selesai' THEN total ELSE 0 END) as total_selesai"),
            DB::raw("COUNT(CASE WHEN status = 'selesai' THEN id END) as transaksi_selesai"),
            DB::raw("COUNT(CASE WHEN status = 'batal' THEN id END) as transaksi_batal")
        )
        ->whereMonth('tanggal', $request->bulan)
        ->whereYear('tanggal', $request->tahun)
        ->groupBy('tgl')
        ->get();

    // transaksi batal
    $jumlah_batal = Penjualan::whereMonth('tanggal', $request->bulan)
        ->whereYear('tanggal', $request->tahun)
        ->where('status', 'batal')
        ->count();

    $total_batal = Penjualan::whereMonth('tanggal', $request->bulan)
        ->whereYear('tanggal', $request->tahun)
        ->where('status', 'batal')
        ->sum('total');

    // transaksi berhasil
    $jumlah_berhasil = Penjualan::whereMonth('tanggal', $request->bulan)
        ->whereYear('tanggal', $request->tahun)
        ->where('status', 'selesai')
        ->count();

    $total_berhasil = Penjualan::whereMonth('tanggal', $request->bulan)
        ->whereYear('tanggal', $request->tahun)
        ->where('status', 'selesai')
        ->sum('total');

    $nama_bulan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $bulan = $nama_bulan[$request->bulan - 1] ?? null;
    return view('laporan.bulanan', [
        'penjualan'       => $penjualan,
        'bulan'           => $bulan,
        'jumlah_berhasil' => $jumlah_berhasil,
        'total_berhasil'  => $total_berhasil,
        'jumlah_batal'    => $jumlah_batal,
        'total_batal'     => $total_batal,
    ]);
}

 public function keuntungan(Request $request)
{
    $bulan = $request->bulan;
    $tahun = $request->tahun;

    // Ambil data penjualan + detail + produk
    $penjualan = Penjualan::with(['detilPenjualan.produk'])
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->where('status', '!=', 'batal')
        ->get();

    $totalPendapatan = 0;
    $totalModal = 0;
    $detail = [];

    foreach ($penjualan as $pj) {
        foreach ($pj->detilPenjualan as $detil) {
            $pendapatan = $detil->jumlah * $detil->harga_produk;   // harga jual
            $modal = $detil->jumlah * $detil->produk->harga_produk; // harga beli supplier
            $laba = $pendapatan - $modal;

            $totalPendapatan += $pendapatan;
            $totalModal += $modal;

            $detail[] = (object) [
                'tanggal' => $pj->tanggal,
                'produk' => $detil->produk->nama_produk ?? '-',
                'jumlah' => $detil->jumlah,
                'harga_jual' => $detil->harga_produk,
                'harga_modal' => $detil->produk->harga_produk,
                'pendapatan' => $pendapatan,
                'modal' => $modal,
                'laba' => $laba,
            ];
        }
    }

    $totalLaba = $totalPendapatan - $totalModal;

    $nama_bulan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei',
        'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    return view('laporan.keuntungan', [
        'bulan' => $bulan,
        'tahun' => $tahun,
        'bulanNama' => $nama_bulan[$bulan - 1] ?? '',
        'detail' => $detail,
        'totalPendapatan' => $totalPendapatan,
        'totalModal' => $totalModal,
        'totalLaba' => $totalLaba,
    ]);
}
}