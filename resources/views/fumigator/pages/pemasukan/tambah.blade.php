@extends('fumigator.layouts.app')

@section('title')
    Tambah Pemasukan
@endsection

@section('content')
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Tambah Penggunaan</h4>

                </div>
            </div>
        </div> --}}
        <!-- end page title -->


        <div class="card shadow mb-3">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-2 font-weight-bold text-primary">List Pemasukan Persediaan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('add.pemasukan') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12">
                            {{-- <div class="card">
                    <div class="card-body"> --}}
                            <div class="mb-3 row">
                                <label for="example-date-input" class="col-md-2 col-form-label">Nama Persediaan</label>
                                <div class="col-md-10">
                                    <select class="form-control select2" style="width: 100%;" name="id_persediaan"
                                        id="id_persediaan">
                                        <option disable value>Pilih Persediaan</option>
                                        @foreach ($dbpersediaan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_persediaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-date-input" class="col-md-2 col-form-label">Jumlah Pemasukan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="jumlah_pemasukan"
                                        name="jumlah_pemasukan">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success"><i
                                            class="fas fa-plus-circle"></i><span>&nbsp;Tambah</span></button>
                                </div>
                            </div>
                            {{-- </div>
                </div> --}}
                        </div> <!-- end col -->
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-2 font-weight-bold text-primary">List Pemasukan Persediaan</h6>
                <a href="{{ route('simpan.pemasukan') }}" class="btn btn-primary"><i
                        class="fas fa-save"></i><span>&nbsp;Simpan</span></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Persediaan</th>
                                <th>Jumlah Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($temporary_pemasukan))
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($temporary_pemasukan as $temp)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $temp['nama_persediaan'] }}
                                        </td>
                                        <td>
                                            {{ $temp['jumlah_pemasukan'] }}
                                        </td>
                                        <td>
                                            <a href="{{ route('destroy.pemasukan', ['id' => $temp['id']]) }}"
                                                class="btn btn-danger">Hapus Ngentot</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#dataTable').DataTable();
    </script>
@endpush
