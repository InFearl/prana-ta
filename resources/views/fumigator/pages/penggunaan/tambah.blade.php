@extends('fumigator.layouts.app')

@section('title')
    Penggunaan
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Tambah Penggunaan</h4>
    
            </div>
        </div>
    </div>
    <!-- end page title -->
    <form action="{{ route('simpan.penggunaan') }}" method="POST">
        {{ csrf_field() }}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 row">
                        <select class="form-control select2" style="width: 100%;" name="id_persediaan" id="id_persediaan">
                            <option disable value>pilih persediaan</option>
                            @foreach ($dbpersediaan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_persediaan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-date-input" class="col-md-2 col-form-label">Tanggal Masuk Pesanan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="date" id="tanggal_penggunaan" name="tanggal_penggunaan" value="2019-08-19"
                                id="example-date-input">
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