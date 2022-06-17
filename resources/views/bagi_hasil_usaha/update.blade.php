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
            <form action="{{ url('administrator/bagi-hasil-usaha/update-data/'.$value->uuid_bagi_hasil) }}"  method="POST" >
                @csrf
               
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Subsidi</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $value->jenis_bagi_hasil }}" class="form-control" name="jenis_bagi_hasil" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $value->nama }}"  class="form-control" name="nama" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Mitra</label>
                    <div class="col-sm-10">
                        <select name="id_mitra" class="form-control" id="" required>
                            <option value="">Select Mitra</option>
                            @foreach($mitra as $v_mitra)
                                <option {{ $value->id_mitra == $v_mitra->id_mitra ? 'selected' : '' }} value="{{ $v_mitra->id_mitra }}">{{ $v_mitra->nama_mitra }}</option>
                            @endforeach
                        </select>
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
                        <input type="date" value="{{ $value->tanggal }}" class="form-control" name="tanggal" required> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nilai</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ number_format($value->nilai) }}"  class="form-control" name="nilai" id="formatrupiah" required> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status_hasil" class="form-control" id="" required>
                            <option {{ $value->status_hasil == 1 ? 'selected' : '' }} value="1">Success</option>
                            <option {{ $value->status_hasil == 2 ? 'selected' : '' }} value="2">On Process</option>
                            <option {{ $value->status_hasil == 3 ? 'selected' : '' }} value="3">Failed</option>
                        </select>
                    </div>
                </div>
                @if(Session::has('update_ok'))
                <div class="alert alert-primary mt-4" role="alert">
                    {{  Session::get('update_ok') }}
                </div>
                @endif
                <br/>
                <input type="submit" value="Ubah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/bagi-hasil-usaha') }}">Cancel</a>

           </form>
        </div>
    </div>
    
</div>
@endsection
