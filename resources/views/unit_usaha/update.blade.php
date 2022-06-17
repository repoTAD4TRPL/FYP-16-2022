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
            <form action="{{ url('administrator/unit-usaha/update-data/'.$value->unit_uuid) }}" enctype="multipart/form-data" method="POST" >
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Unit</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="nama_unit" value="{{ $value->nama_unit }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Dibuka</label>
                    <div class="col-sm-10">
                        <input type="date"  class="form-control" name="tanggal_dibuka" value="{{ $value->tanggal_dibuka }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-lg-8">
                                <input type="file" name="image" accept="image/png, image/jpeg, image/jpg" class="form-control" >
                            </div>
                            <div class="col-lg-4">
                                <a target="_blank" href="{{ $value->image !='' ? URL::to('assets/images/unit-usaha/'.$value->image) : 'http://placehold.it/150' }}">
                                    <img style="width:150px; height:150px; float:right; object-fit: cover;" class="card-img-top" src="{{ $value->image !='' ? URL::to('assets/images/unit-usaha/'.$value->image) : 'http://placehold.it/150' }}" alt="Card image cap">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10" required>{{ $value->deskripsi }}</textarea>
                    </div>
                </div><div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Asset</label>
                    <div class="col-sm-10">
                        <textarea name="aset" class="form-control" id="" cols="30" rows="3" required>{{ $value->aset }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Laporan Keuangan</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="lapkeu" value="{{ $value->lapkeu }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Laporan Kegiatan</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="lapkeg" value="{{ $value->lapkeg }}">
                    </div>
                </div>
                @if(Session::has('update_ok'))
                <div class="alert alert-primary mt-4" role="alert">
                    {{  Session::get('update_ok') }}
                </div>
                @endif
                <br/>
                <input type="submit" value="Ubah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/unit-usaha') }}">Cancel</a>

           </form>
        </div>
    </div>
    
</div>
@endsection
