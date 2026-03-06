@extends('layouts.laporan',['title'=>'Laporan Harian'])
@section('content')

<h1 class="text-center mb-3">Laporan Harian</h1>

<p>Tanggal : {{ date('d/m/Y', strtotime( request()->tanggal )) }}</p>
<div class="card-body">

<table class="table table-bordered table-striped table-hover">
    <thead class="table-primary text-center">
        <tr>
            <th>No</th>
            <th>No. Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Kasir</th>
            <th>Produk Terjual</th>
            <th>Status</th>
            <th>Waktu</th>
            <th>Total</th>
            <th>Pajak (5%)</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
            $total_pajak_berhasil = 0;
            $ppn_rate = 0.05; // Mengatur tarif PPN menjadi 5%
        @endphp
        @php $no = 1; @endphp
        @foreach ($penjualan as $item)
       @php
 // Menghitung pajak dari nilai total, dengan asumsi total sudah termasuk 10% PPN
 $pajak = ($item->status != 'batal') ? $item->subtotal - ($item->subtotal / (1 + $ppn_rate)) : 0;
if ($item->status != 'batal') {
$total_pajak_berhasil += $pajak;
 }
@endphp
            <tr @if($item->status == 'batal') style="background:#f8d7da" @endif>
                <td>{{ $no++ }}</td>
                <td>{{ $item->nomor_transaksi }}</td>
                <td>{{ $item->nama_pelanggan }}</td>
                <td>{{ $item->nama_kasir }}</td>
                <td>
    @if(isset($detil[$item->id]))
        @foreach($detil[$item->id] as $d)
            - {{ $d->nama }} ({{ $d->jumlah }}) <br>
        @endforeach
    @endif
</td>


                <td>
                    @if($item->status == 'selesai')
                        <span class="badge bg-success">{{ ucwords($item->status) }}</span>
                    @elseif($item->status == 'batal')
                        <span class="badge bg-danger">{{ ucwords($item->status) }}</span>
                    @else
                        <span class="badge bg-warning text-dark">{{ ucwords($item->status) }}</span>
                    @endif
                </td>
                <td>{{ date('H:i:s', strtotime($item->tanggal)) }}</td>
                <td>
                     @php
                        // Perhitungan pajak diambil dari item->subtotal
                        $pajak = ($item->status != 'batal') ? $item->subtotal * $ppn_rate : 0;
                        if ($item->status != 'batal') {
                            $total_pajak_berhasil += $pajak;
                        }   
                    @endphp
                    @if($item->status == 'batal')
                        <s>{{ number_format($item->subtotal , 0, ',', '.') }}</s>
                    @else
                        {{ number_format($item->subtotal, 0, ',', '.') }}
                    @endif
                </td>   
                <td>
                   
                    @if($item->status == 'batal')
                        <s>{{ number_format(round($pajak), 0, ',', '.') }}</s>
                    @else
                        {{ number_format(round($pajak), 0, ',', '.') }}
                    @endif
                </td>
                    </tr>

            @endforeach
                
        {{-- Jumlah Total Semua Transaksi Selesai --}}
        <tr>
            <th colspan="7" style="text-align:right;">Jumlah Total</th>
            <th>{{ number_format($penjualan->where('status','!=','batal')->sum('subtotal'), 0, ',', '.') }}</th>
        </tr>
    </tbody>
</table>

<div class="card mt-4">
    <div class="card-header bg-warning text-dark">
        <i class="fas fa-star"></i> PRODUK TERLARIS HARI INI
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Terjual</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produk_terlaris as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td class="text-center">{{ $item->total_terjual }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada transaksi hari ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<h4 class="mt-4">📊 KESIMPULAN</h4>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>Status</th>
            <th>Jumlah Transaksi</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-success">
            <td><b>✔ Transaksi Berhasil</b></td>
            <td>{{ $jumlah_berhasil }}</td>
            <td>{{ number_format($total_berhasil, 0, ',', '.') }}</td>
        </tr>
        <tr class="table-danger">
            <td><b>✘ Transaksi Batal</b></td>
            <td>{{ $jumlah_batal }}</td>
            <td>{{ number_format($total_batal, 0, ',', '.') }}</td>
        </tr>
        <tr class="table-info">
            <td><b>💰 Total Semua Transaksi</b></td>
            <td>{{ $jumlah_berhasil + $jumlah_batal }}</td>
            <td>{{ number_format($total_berhasil + $total_batal, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>

@endsection