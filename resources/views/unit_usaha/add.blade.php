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
            <form action="{{ url('administrator/unit-usaha/create') }}" enctype="multipart/form-data" method="POST" >
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Unit</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="nama_unit" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Dibuka</label>
                    <div class="col-sm-10">
                        <input type="date"  class="form-control" name="tanggal_dibuka" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" accept="image/png, image/jpeg, image/jpg" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Asset</label>
                    <div class="col-sm-10">
                        <textarea name="aset" class="form-control" id="" cols="30" rows="3" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Link Detail Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="lapkeu">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Link Tambah Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="lapkeg">
                    </div>
                </div>
                <br/>
                <input type="submit" value="Tambah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/unit-usaha') }}">Cancel</a>

           </form>
        </div>
    </div>

</div>
@endsection
