@extends('component.layout')

@section('content')
<div class="container p-4">
    <div class="row mt-4 mb-4">
        <div class="col-lg-6">
            <h5>{{ $title }}</h5>
        </div>
        <div class="col-lg-6">
        </div>
    </div>
 
    <div class="card p-4" style="width:100%;">
        <div class="card-body">
            <form action="{{ url('administrator/asset/create') }}"  method="POST" >
                @csrf
               
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="nama_asset" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nomor Barang</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="nomor_asset" required> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="10" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                    <div class="col-sm-10">
                        <input type="date"  class="form-control" name="tanggal_terdaftar" required> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Harga Barang</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="nilai_asset" id="formatrupiah" required> 
                    </div>
                </div>
               
               
                <br/>
                <input type="submit" value="Tambah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/asset') }}">Cancel</a>

           </form>
        </div>
    </div>
    
</div>
@endsection
