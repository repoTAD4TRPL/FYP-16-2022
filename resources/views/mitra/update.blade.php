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
            <form action="{{ url('administrator/mitra/update-data/'.$value->uuid_mitra) }}"  method="POST" >
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text"  value="{{ $value->nama_mitra }}" class="form-control" name="nama_mitra" required> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Bidang</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $value->bidang }}" class="form-control" name="bidang" required> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Mulai Kerjasama</label>
                    <div class="col-sm-10">
                        <input type="date" value="{{ $value->tanggal_mulai }}" class="form-control" name="tanggal_mulai" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Selesai Kerjasama</label>
                    <div class="col-sm-10">
                        <input type="date" value="{{ $value->tanggal_selesai }}" class="form-control" name="tanggal_selesai" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status_mitra" class="form-control" id="" required>
                            <option {{ $value->status_mitra == 1 ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $value->status_mitra == 2 ? 'selected' : '' }} value="2">Inactive</option>
                        </select>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alamat" class="form-control" id="" cols="30" rows="10" required>{{ $value->alamat }}</textarea>
                    </div>
                </div>
                @if(Session::has('update_ok'))
                <div class="alert alert-primary mt-4" role="alert">
                    {{  Session::get('update_ok') }}
                </div>
                @endif
                <br/>
                <input type="submit" value="Ubah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/mitra') }}">Cancel</a>

           </form>
        </div>
    </div>
    
</div>
@endsection
