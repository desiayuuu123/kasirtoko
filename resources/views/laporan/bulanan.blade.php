@extends('layouts.laporan', ['title' => 'Laporan Bulanan'])

@section('content')
    <h1 class="text-center mb-3">Laporan Bulanan</h1>
    <p>Bulan : {{ $bulan }} {{ request()->tahun }}</p>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Transaksi Berhasil</th>
                <th>Transaksi Batal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($penjualan as $key => $row)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $row->tgl }}</td>
                <td>{{ $row->transaksi_selesai }}</td>
                <td>{{ $row->transaksi_batal }}</td>
                <td>{{ number_format($row->total_selesai, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
    <tr>
        <th colspan="2">Jumlah Total</th>
        <th class="table-success fw-bold">{{ $jumlah_berhasil }}</th>
        <th class="table-danger fw-bold">{{ $jumlah_batal }}</th>
        <th>{{ number_format($total_berhasil, 0, ',', '.') }}</th>
    </tr>
</tfoot>

    </table>

    <h4 class="mt-4">📊 KESIMPULAN</h4>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Status</th>
                    <th>Jumlah Transaksi</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-success">
                    <td>
                        <i class="fas fa-check"></i> Transaksi Berhasil
                    </td>
                    <td class="text-center">{{ $jumlah_berhasil }}</td>
                    <td class="text-end">{{ number_format($total_berhasil, 0, ',', '.') }}</td>
                </tr>
                <tr class="table-danger">
                    <td>
                        <i class="fas fa-times"></i> Transaksi Batal
                    </td>
                    <td class="text-center">{{ $jumlah_batal }}</td>
                    <td class="text-end">{{ number_format($total_batal, 0, ',', '.') }}</td>
                </tr>
                <tr class="table-info">
                    <td>
                        <i class="fas fa-coins"></i> Total Semua Transaksi
                    </td>
                    <td class="text-center">{{ $jumlah_berhasil + $jumlah_batal }}</td>
                    <td class="text-end">{{ number_format($total_berhasil + $total_batal, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection