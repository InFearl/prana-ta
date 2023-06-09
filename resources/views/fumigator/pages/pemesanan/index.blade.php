@extends('fumigator.layouts.app')

@section('title')
    pemesanan
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div >
            <a href="{{ route('tambah.pemesanan') }}" class="btn btn-success" ><i class="fas fa-plus"></i><span>Tambah</span></a>
            {{-- <a href="{{ route('cetak.pemesanan') }}" target="_blank" class="btn btn-success" ><i class="fas fa-print"></i><span>Cetak</span></a> --}}
        </div>
        <div class="card-body">
            {{-- <form action="{{ route('penggunaan.add') }}" method="POST">
                {{ csrf_field() }} --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Status Pesanan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Biaya Pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $dbpemesanan as $item)
                            
                        <tr>
                            <td>{{ $item->id}}</td>
                            <td>{{ $item->status_pemesanan }}</td>
                            <td>{{ $item->biaya_pemesanan}}</td>
                            <td>
                                <a class="btn btn-info btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection