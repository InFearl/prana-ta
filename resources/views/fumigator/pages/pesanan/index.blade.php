@extends('fumigator.layouts.app')

@section('title')
    Pesanan
@endsection

@section('content')
<div class="container-fluid">    
    <h1 class="h3 mb-0 text-gray-800">Pesanan</h1>    
    <div>
        <button type="button" class="btn btn-success">konfirmasi</button>
        <a href="{{ route('tambah.pesanan') }}" class="btn btn-success" 
            ><i class="fas fa-plus"></i><span>Tambah</span></a>
        <button type="button" class="btn btn-success">Cetak</button>
    </div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id Pesanan</th>
                        <th>Nama Perusahaan</th>
                        <th>20ft</th>
                        <th>40ft</th>
                        <th>Tanggal Masuk Pesanan</th>
                        <th>Deadline Pesanan</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id Pesanan</th>
                        <th>Nama Perusahaan</th>
                        <th>20ft</th>
                        <th>40ft</th>
                        <th>Tanggal Masuk Pesanan</th>
                        <th>Deadline Pesanan</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ( $dbpesanan as $item)
                        
                    <tr>
                        <td>{{ $item->id}}</td>
                        <td>{{ $item->nama_perusahaan }}</td>
                        <td>{{ $item->c20ft }}</td>
                        <td>{{ $item->c40ft }}</td>
                        <td>{{ date('d-m-y', strtotime($item->tanggal_masuk)) }}</td>
                        <td>{{ date('d-m-y', strtotime($item->tanggal_akhir)) }}</td>
                        <td>{{ $item->status_pesanan }}</td>
                        <td>
                            <a href="{{ url('ubah.pesanan', $item->id) }}" class="btn btn-info btn-circle btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="{{ url('delete.pesanan', $item->id) }}" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $dbpesanan->links() }}
    </div>
</div>
</div>
@endsection