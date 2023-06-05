@extends('fumigator.layouts.app')

@section('title')
    Penggunaan
@endsection

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Penggunaan Persediaan</h1>
    	<div >
            <a href="{{ route('tambah.penggunaan') }}" class="btn btn-success" 
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
                        <th>Id</th>
                        <th>Nama Persediaan</th>
                        <th>Tanggal Penggunaan Persediaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nama Persediaan</th>
                        <th>Tanggal Penggunaan Persediaan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ( $dbpenggunaan as $item)
                        
                    <tr>
                        <td>{{ $item->id}}</td>
                        <td>{{ $item->persediaan->nama_persediaan ?? 'kosong'}}</td>
                        <td>{{ date('d-m-y', strtotime($item->tanggal_penggunaan)) }}</td>
                        <td>
                            <a href="{{ url('ubah.penggunaan', $item->id) }}" class="btn btn-info btn-circle btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="{{ url('delete.penggunaan', $item->id) }}" class="btn btn-danger btn-circle btn-sm">
                                <i class="fas fa-trash"></i>
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