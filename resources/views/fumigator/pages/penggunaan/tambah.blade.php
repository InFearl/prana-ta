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
                <h6 class="m-2 font-weight-bold text-primary">Pilih Persediaan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('add.penggunaan') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-12">
                            {{-- <div class="card">
                    <div class="card-body"> --}}
                            <div class="mb-3 row">
                                <label for="example-date-input" class="col-md-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-md-10">
                                    <select class="form-control select2" style="width: 100%;" name="id_pesanan"
                                        id="id_persediaan">
                                        <option disable value>Pilih Pesanan</option>
                                        @foreach ($dbpesanan as $pesanan)
                                            <option value="{{ $pesanan->id }}">{{ $pesanan->nama_perusahaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                                <label for="example-date-input" class="col-md-2 col-form-label">Jumlah Penggunaan</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="jumlah_penggunaan"
                                        name="jumlah_penggunaan">
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
                <h6 class="m-2 font-weight-bold text-primary">List Penggunaan Persediaan</h6>
                <a href="{{ route('simpan.penggunaan') }}" class="btn btn-primary"><i
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
                            @if (!empty($temporary_penggunaan))
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($temporary_penggunaan as $temp)
                                    <tr>
                                        <td>
                                            {{ $no++ }}
                                        </td>
                                        <td>
                                            {{ $temp['nama_persediaan'] }}
                                        </td>
                                        <td>
                                            {{ $temp['jumlah_penggunaan'] }}
                                        </td>
                                        <td>
                                            <a href="{{ route('destroy.penggunaan', ['id' => $temp['id']]) }}"
                                                class="btn btn-danger">Hapus</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#dataTable').DataTable();
        @if (session()->has('alert'))
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                    window.location.href = '/confirm-save';
                }
            })
        @endif
    </script>
@endpush
