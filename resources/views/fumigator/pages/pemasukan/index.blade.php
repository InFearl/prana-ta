@extends('fumigator.layouts.app')

@section('title')
    Pemasukan
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pemasukan Persediaan</h1>
        <div>
            <a href="{{ route('tambah.pemasukan') }}" class="btn btn-success"><i
                    class="fas fa-plus"></i><span>Tambah</span></a>
            @if (Auth::guard('users')->user()->role=="manager")
                <a href="{{ route('cetak.pemasukan') }}" target="_blank" class="btn btn-success"><i
                class="fas fa-print"></i><span>Cetak</span></a>
            @endif
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tanggal Penggunaan Persediaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Tanggal Penggunaan Persediaan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dbpemasukan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ date('d F Y', strtotime($item->tanggal_pemasukan)) }}</td>
                                    <td>
                                        {{-- <a href="{{ url('ubah.penggunaan', $item->id) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="{{ url('delete.penggunaan', $item->id) }}"
                                            class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                        <a href="{{ url('show.pemasukan', $item->id) }}" class="btn btn-info">
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
