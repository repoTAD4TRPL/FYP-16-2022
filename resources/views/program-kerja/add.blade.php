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
            <form action="{{ url('administrator/program-kerja/create') }}"  method="POST" >
                @csrf

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Program</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="program" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Kegiatan</label>
                    <div class="col-sm-10">
                        <textarea type="text" cols="30" rows="10" class="form-control" name="kegiatan" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Alokasi Anggaran</label>
                    <div class="col-sm-10">
                    <input type="text"  class="form-control" name="anggaran" id="formatrupiah" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Sumber</label>
                    <div class="col-sm-10">
                    <input name="sumber" class="form-control" id="" required></input>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Output</label>
                    <div class="col-sm-10">
                    <input type="text"  class="form-control" name="output" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Indikator Keberhasilan</label>
                    <div class="col-sm-10">
                        <textarea type="text" cols="30" rows="10" class="form-control" name="indikator" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Waktu pelaksanaan</label>
                    <div class="col-sm-10">
                    <input type="date"  class="form-control" name="waktu" required>
                    </div>
                </div>

                <br/>
                <input type="submit" value="Tambah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/program-kerja') }}">Cancel</a>

           </form>
        </div>
    </div>

</div>
@endsection
