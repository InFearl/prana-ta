@extends('fumigator.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Pesanan Masuk</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_pesanan }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Pesanan Dijalankan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_pesanan_dijalankan }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Container Selesai </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_pesanan_container_selesai }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Container Dijalankan </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $jumlah_pesanan_container_dijalankan }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::guard('users')->user()->role == 'fumigator' || Auth::guard('users')->user()->role == 'manager')
            <div class="card shadow mb-4">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama Persediaan</th>
                                <th>Stock Persediaan</th>
                                <th>ROP</th>
                                <th>Safety Stock</th>
                                <th>Indikator</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Nama Persediaan</th>
                                <th>Stock Persediaan</th>
                                <th>ROP</th>
                                <th>Safety Stock</th>
                                <th>Indikator</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dbpersediaan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_persediaan }}</td>
                                    <td>{{ $item->jumlah_persediaan }}</td>
                                    {{-- <td>{{ $item-> }}</td> --}}
                                    <td>{{ $item->rop }}
                                    <td>{{ $item->safety_stock }}</td>
                                    
                                    </td>
                                    <td>
                                        @if ($item->jumlah_persediaan <= $item->safety_stock)
                                        <a href="{{ route('tambah.pemesanan') }}" class="btn btn-danger"><i
                                            ></i><span>Lakukan Pemesanan</span></a>
                                        @elseif ($item->jumlah_persediaan <= $item->rop)
                                        <a href="{{ route('tambah.pemesanan') }}" class="btn btn-warning"><i
                                            ></i><span>Segera Memesan</span></a>
                                        @else
                                        {{-- <button type="button" class="btn btn-success" >Aman</button> --}}
                                        <a  class="btn btn-success"><i
                                            ></i><span>Aman</span></a>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
