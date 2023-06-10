@extends('fumigator.layouts.app')

@section('title')
    Detail Pemesanan
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pemesanan Persediaan</h1>
        <div>
            {{-- <a href="{{ route('tambah.penggunaan') }}" class="btn btn-success"><i
                    class="fas fa-plus"></i><span>Tambah</span></a>
            <a href="{{ route('cetak.penggunaan') }}" target="_blank" class="btn btn-success"><i
                    class="fas fa-print"></i><span>Cetak</span></a> --}}
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id Persediaan</th>
                                <th>Nama Persediaan</th>
                                <th>Jumlah Pemesanan</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>
                            @foreach ($dbpemesanan as $item)
                                <tr>
                                    <td>{{ $item->id_persediaan }}</td>
                                    <td>{{ $item->persediaan->nama_persediaan }}</td>
                                    <td>{{ $item->jumlah_pemesanan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
