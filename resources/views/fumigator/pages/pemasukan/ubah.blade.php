@extends('fumigator.layouts.app')

@section('title')
    Pemasukan
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tambah Pemasukan</h4>
    
            </div>
        </div>
    </div>
    <!-- end page title -->
    <form action="{{ url('update.pemasukan',$pem->id) }}" method="POST">
        {{ csrf_field() }}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="example-date-input" class="col-md-2 col-form-label">Tanggal Pemasukan Persediaan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" id="tanggal_pemasukan" name="tanggal_pemasukan" value="{{ $pem->tanggal_pemasukan }}"
                                id="example-date-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input"class="col-md-2 col-form-label">Biaya Total</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" id="biaya_total" name="biaya_total" value="{{ $pem->biaya_total }}"
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