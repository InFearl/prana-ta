@extends('fumigator.layouts.app')

@section('title')
    Pesanan
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Cetak Laporan Pesanan</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('filter.pesanan') }}" method="post">
                    @csrf
                    <div class="row my-3">
                        <div class="col-5 d-flex">
                            <label for="" class="m-2">Tanggal</label>
                            <input type="month" name="bulan_tahun" id="bulan_tahun" class="form-control">
                        </div>
                        <div class="col-1">
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                        <div class="col-1">
                            @if (!empty($bulan_tahun))
                                <a href="{{ route('cetak.pesanan', ['bulan_tahun' => $bulan_tahun]) }}"
                                    class="btn btn-success">Cetak</a>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Perusahaan</th>
                                <th>Container</th>
                                <th>Tanggal Masuk Pesanan</th>
                                <th>Deadline Pesanan</th>
                                <th>Status Pesanan</th>
                                @if (Auth::guard('users')->user()->role == 'administrasi')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama Perusahaan</th>
                                <th>Container</th>
                                <th>Tanggal Masuk Pesanan</th>
                                <th>Deadline Pesanan</th>
                                <th>Status Pesanan</th>
                                @if (Auth::guard('users')->user()->role == 'administrasi')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (!empty($dbpesanan))
                                @foreach ($dbpesanan as $item)
                                    <tr>
                                        <td>{{ $item->nama_perusahaan }}</td>
                                        <td>{{ $item->container }}</td>
                                        <td>{{ date('d-m-y', strtotime($item->tanggal_masuk)) }}</td>
                                        <td>{{ date('d-m-y', strtotime($item->tanggal_akhir)) }}</td>
                                        <td>
                                            <label
                                                class="badge {{ $item->status_pesanan == 1 ? 'badge-success' : 'badge-danger' }}">{{ $item->status_pesanan == 1 ? 'Selesai' : 'Proses Pengerjaan' }}</label>
                                        </td>
                                        @if (Auth::guard('users')->user()->role == 'administrasi')
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
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="card-footer">
                {{ $dbpesanan->links() }}
            </div> --}}
        </div>
    </div>
@endsection
