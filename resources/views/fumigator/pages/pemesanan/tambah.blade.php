@extends('fumigator.layouts.app')

@section('title')
    Penggunaan
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
                <h6 class="m-2 font-weight-bold text-primary">List Pemesanan Persediaan</h6>
                <!-- Button trigger modal -->
                @if (!empty($temporary_pemesanan))
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                        Biaya Pemesanan
                    </button>
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('add.pemesanan') }}" method="POST">
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
                            {{-- <div class="mb-3 row">
                                <label for="example-date-input" class="col-md-2 col-form-label">Jumlah Penggunaan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="jumlah_pemesanan"
                                        name="jumlah_pemesanan">
                                </div>
                            </div> --}}
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
                <h6 class="m-2 font-weight-bold text-primary">List Penggunaan Persediaan</h6>
                <a href="{{ route('simpan.pemesanan') }}" class="btn btn-primary"><i
                        class="fas fa-save"></i><span>&nbsp;Simpan</span></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Persediaan</th>
                                <th>EOQ</th>
                                <th>Jumlah Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($temporary_pemesanan))
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($temporary_pemesanan as $temp)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $temp['nama_persediaan'] }}
                                        </td>
                                        <td>
                                            {{ $temp['eoq'] }}
                                        </td>
                                        <td>
                                            {{ $temp['jumlah_pemesanan'] }}
                                        </td>
                                        <td>
                                            edit
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Biaya Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="col-12">
                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <input class="form-control" type="text" id="biaya_pemesanan" name="biaya_pemesanan">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
