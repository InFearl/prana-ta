@extends('fumigator.layouts.app')

@section('title')
    Pemasukan
@endsection

@section('content')
<div class="container-fluid">

<h1 class="h3 mb-2 text-gray-800">Pemasukan Persediaan</h1>
    	<div >
            <a href="{{ route('tambah.pemasukan') }}" class="btn btn-success"><i class="fas fa-plus"></i><span>Tambah</span></a>
            <a href="{{ route('cetak.pemasukan') }}" target="_blank" class="btn btn-success" ><i class="fas fa-print"></i><span>Cetak</span></a>
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
                        <th>Jumlah Penggunaan</th>
                        <th>Tanggal Masuk Persediaan</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nama Persediaan</th>
                        <th>Jumlah Penggunaan</th>
                        <th>Tanggal Masuk Persediaan</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ( $dbpemasukan as $item)
                        
                    <tr>
                        <td>{{ $item->id}}</td>
                        <td>{{ $item->persediaan->nama_persediaan ?? 'kosong'}}</td>
                        <td>{{ $item->jumlah_pemasukan}}</td>
                        <td>{{ date('d-m-y', strtotime($item->tanggal_pemasukan)) }}</td>
                        <td>{{ $item->biaya_total}}</td>
                        <td>
                            <a href="{{ url('ubah.pemasukan', $item->id) }}" class="btn btn-info btn-circle btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="{{ url('delete.pemasukan', $item->id) }}" class="btn btn-danger btn-circle btn-sm">
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