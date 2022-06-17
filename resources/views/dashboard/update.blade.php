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
            <form action="{{ url('administrator/programkerja/update-data/'.$value->uuid_pk) }}"  method="POST" >
                @csrf
               
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Program/Kegiatan</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $value->program }}" class="form-control" name="program" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Alokasi Anggaran</label>
                    <div class="col-sm-10">
                    <input type="text" value="{{ $value->anggaran }}"  class="form-control" name="anggaran" id="formatrupiah" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Sumber</label>
                    <div class="col-sm-10">
                    <input name="sumber" value="{{ $value->sumber }}" class="form-control" id="" required></input>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Output</label>
                    <div class="col-sm-10">
                    <input type="text" value="{{ $value->output }}" class="form-control" name="output" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Indikator Keberhasilan</label>
                    <div class="col-sm-10">
                    <textarea name="indikator" class="form-control" id="" cols="30" rows="10" required>{{ $value->indikator }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Waktu pelaksanaan</label>
                    <div class="col-sm-10">
                    <input type="date" value="{{ $value->waktu }}" class="form-control" name="waktu" required> 
                    </div>
                </div>
                @if(Session::has('update_ok'))
                <div class="alert alert-primary mt-4" role="alert">
                    {{  Session::get('update_ok') }}
                </div>
                @endif
                <br/>
                <input type="submit" value="Ubah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/dashboard') }}">Cancel</a>

           </form>
        </div>
    </div>
    
</div>
@endsection
