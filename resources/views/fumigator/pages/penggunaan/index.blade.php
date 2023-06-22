@extends('fumigator.layouts.app')

@section('title')
    Penggunaan
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Penggunaan Persediaan</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-start mb-4">
                        <a href="{{ route('tambah.penggunaan') }}" class="btn btn-success mx-1"><i
                        class="fas fa-plus"></i><span>Tambah</span></a>
                    @if (Auth::guard('users')->user()->role=="manager")
                        <a href="{{ route('cetak.penggunaan') }}" target="_blank" class="btn btn-success mx-1"><i
                        class="fas fa-print"></i><span>Cetak</span></a>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Perusahaan</th>
                                <th>Tanggal Penggunaan Persediaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Nama Perusahaan</th>
                                <th>Tanggal Penggunaan Persediaan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dbpenggunaan as $item)
                                <tr>
                                    <td>{{ $item->pesanan->id }}</td>
                                    <td>{{ $item->pesanan->nama_perusahaan }}</td>
                                    <td>{{ date('d F Y', strtotime($item->tanggal_penggunaan)) }}</td>
                                    <td>
                                        {{-- <a href="{{ url('ubah.penggunaan', $item->id) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="{{ url('delete.penggunaan', $item->id) }}"
                                            class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                        <a href="{{ url('show.penggunaan', $item->id) }}"
                                            class="btn btn-info">
                                            <i class="fas fa-info-circle"></i> Detail
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
