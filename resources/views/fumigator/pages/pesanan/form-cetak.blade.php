@extends('fumigator.layouts.app')

@section('title')
    Pesanan
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Cetak Laporan Pesanan</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div>
                    <label for="label">Tanggal Awal</label>
                    <input type="date" name="tglawal" id="tglawal" class="form-control"/>
                </div>
                <div>
                    <label for="label">Tanggal Akhir</label>
                    <input type="date" name="tglakhir" id="tglakhir" class="form-control"/>
                </div>
                <div class="d-flex justify-content-start mb-4">
                    <a href="" onclick="this.href='{{ route('cetak.pesanan') }}'
                    + document.getElementById('tglawal').value + '/' 
                    + document.getElementById('tglakhir').value" target="blank" class="btn btn-success mx-1">
                    Cetak Laporan Pesanan
                    </a>
                    {{-- @if (Auth::guard('users')->user()->role=="manager")
                    <a href="" onclick="this.href='{{ route('cetak.pesanan') + document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value}}'
                    + document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value" target="_blank" class="btn btn-success mx-1"><i
                    class="fas fa-print"></i><span>Cetak</span></a>
                    @endif --}}
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id Pesanan</th>
                                <th>Nama Perusahaan</th>
                                <th>Container</th>
                                <th>Tanggal Masuk Pesanan</th>
                                <th>Deadline Pesanan</th>
                                <th>Status Pesanan</th>
                                @if (Auth::guard('users')->user()->role=="administrasi")
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id Pesanan</th>
                                <th>Nama Perusahaan</th>
                                <th>Container</th>
                                <th>Tanggal Masuk Pesanan</th>
                                <th>Deadline Pesanan</th>
                                <th>Status Pesanan</th>
                                @if (Auth::guard('users')->user()->role=="administrasi")
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dbpesanan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nama_perusahaan }}</td>
                                    <td>{{ $item->container }}</td>
                                    <td>{{ date('d-m-y', strtotime($item->tanggal_masuk)) }}</td>
                                    <td>{{ date('d-m-y', strtotime($item->tanggal_akhir)) }}</td>
                                    <td>
                                        <label class="badge {{ ($item->status_pesanan == 1) ? 'badge-success' : 'badge-danger'}}">{{ ($item->status_pesanan == 1) ? 'Selesai' : 'Proses Pengerjaan'}}</label>
                                    </td>
                                    @if (Auth::guard('users')->user()->role=="administrasi")
                                    <td>
                                        <a href="{{ url('ubah.pesanan', $item->id) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="{{ url('delete.pesanan', $item->id) }}"
                                            class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    @endif
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
