@extends('fumigator.layouts.app')

@section('title')
    Pemesanan
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pemesanan Persediaan</h1>
        <div>
            <a href="{{ route('tambah.pemesanan') }}" class="btn btn-success"><i
                    class="fas fa-plus"></i><span>Tambah</span></a>
            <a href="{{ route('cetak.pemesanan') }}" target="_blank" class="btn btn-success"><i
                    class="fas fa-print"></i><span>Cetak</span></a>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Status Pesanan</th>
                                <th>Tanggal Pemesanan Persediaan</th>
                                <th>Biaya Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Status Pesanan</th>
                                <th>Tanggal Pemesanan Persediaan</th>
                                <th>Biaya Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dbpemesanan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->pemesanan->status_pemesanan }}</td>
                                    <td>{{ date('d-m-y', strtotime($item->tanggal_pemesanan)) }}</td>
                                    <td>{{ $item->pemesanan->biaya_pemesanan }}</td>
                                    <td>
                                        {{-- <a href="{{ url('ubah.penggunaan', $item->id) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="{{ url('delete.penggunaan', $item->id) }}"
                                            class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                        <a href="{{ url('show.pemesanan', $item->id) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
