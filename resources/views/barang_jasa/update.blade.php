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
            <form action="{{ url('administrator/barang-jasa/update-data/'.$value->uuid_barang_jasa) }}"  method="POST" >
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Unit</label>
                    <div class="col-sm-10">
                        <select name="id_unit" class="form-control" id="" required>
                            <option value="">Select Unit</option>
                            @foreach($unit as $v_unit)
                                <option {{ $v_unit->id_unit == $value->id_unit ? 'selected' : '' }} value="{{ $v_unit->id_unit }}">{{ $v_unit->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control" id="" required>
                            <option value="">Select Jenis</option>
                            <option {{ $value->jenis == '1' ? 'selected' : '' }} value="1">Sewa</option>
                            <option {{ $value->jenis == '2' ? 'selected' : '' }} value="2">Beli</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $value->nama }}" class="form-control" name="nama" required> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $value->jumlah }}" class="form-control" name="jumlah" required> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" value="{{ $value->tanggal }}"  class="form-control" name="tanggal" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text"  value="{{ number_format($value->harga) }}" class="form-control" name="harga" id="formatrupiah" required> 
                    </div>
                </div>
                @if(Session::has('update_ok'))
                <div class="alert alert-primary mt-4" role="alert">
                    {{  Session::get('update_ok') }}
                </div>
                @endif
                <br/>
                <input type="submit" value="Ubah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/barang-jasa') }}">Cancel</a>

           </form>
        </div>
    </div>
    
</div>
@endsection
