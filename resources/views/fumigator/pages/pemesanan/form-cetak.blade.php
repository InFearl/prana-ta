@extends('fumigator.layouts.app')

@section('title')
    Pemesanan
@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Cetak Laporan Pemesanan</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('filter.pemesanan') }}" method="post">
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
                                <a href="{{ route('cetak.pemesanan', ['bulan_tahun' => $bulan_tahun]) }}"
                                    class="btn btn-success">Cetak</a>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Persediaan</th>
                                <th>Jumlah Pemesanan</th>
                                <th>Tanggal Pemesanan Persediaan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama Persediaan</th>
                                <th>Jumlah Pemesanan</th>
                                <th>Tanggal Pemesanan Persediaan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (!empty($dbpemesanan))
                                @foreach ($dbpemesanan as $item)
                                    <tr>
                                        <td>{{ $item->nama_persediaan ?? 'kosong' }}</td>
                                        <td>{{ $item->jumlah_pemesanan ?? 'kosong' }}</td>
                                        <td>{{ date('d F Y', strtotime($item->tanggal_pemesanan)) }}</td>
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
