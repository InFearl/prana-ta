@extends('fumigator.layouts.app')

@section('title')
    pemesanan
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('simpan.pemesanan') }}" method="POST">
                {{ csrf_field() }}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Persediaan</th>
                            <th>Jumlah Persediaan</th>
                            <th>ROP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $dbpersediaan as $item)
                            
                        <tr>
                            <td>{{ $item->id}}</td>
                            <td>{{ $item->nama_persediaan }}</td>
                            <td>{{ $item->jumlah_persediaan}}</td>
                            <td>{{ $item->rop}}</td>
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
    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- <form action="{{ route('penggunaan.add') }}" method="POST">
                {{ csrf_field() }} --}}
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Persediaan</th>
                            <th>Jumlah Pemesanan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Status Pemesanan</th>
                            <th>Biaya pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $dbpemesanan as $item)
                        <tr>
                            <td>{{ $item->id}}</td>
                            <td>{{ $item->persediaan->nama_persediaan }}</td>
                            <td>{{ $item->jumlah_pemesanan}}</td>
                            <td>{{ date('d-m-y', strtotime($item->tanggal_pemesanan)) }}</td>
                            <td>{{ $item->status_pemesanan}}</td>
                            <td>{{ $item->biaya_total}}</td>
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