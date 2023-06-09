@extends('fumigator.layouts.app')

@section('title')
    Pesanan
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tambah Pesanan</h4>
    
            </div>
        </div>
    </div>
    <!-- end page title -->
    <form action="{{ route('simpan.pesanan') }}" method="POST">
        {{ csrf_field() }}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
    
                    <div class="mb-3 row">
                        <label for="example-text-input"class="col-md-2 col-form-label">Nama</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama perusahaan"
                                id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-number-input" class="col-md-2 col-form-label">container</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" id="container" name="container" placeholder="Jumlah Container" id="example-number-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-date-input" class="col-md-2 col-form-label">Tanggal Masuk Pesanan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" id="tanggal_masuk" name="tanggal_masuk" value="2019-08-19"
                                id="example-date-input">
                        </div>
                    </div>  
                    <div class="mb-3 row">
                        <label for="example-date-input" class="col-md-2 col-form-label">Deadline Pesanan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" id="tanggal_akhir" name="tanggal_akhir" value="2019-08-19"
                                id="example-date-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input"class="col-md-2 col-form-label">Status Pesanan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="status_pesanan" name="status_pesanan" placeholder="Status Pesanan"
                                id="example-text-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>  
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    </form>
</div>
@endsection