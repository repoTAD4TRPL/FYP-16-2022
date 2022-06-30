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
            <form action="{{ url('administrator/homestay/update-data/'.$value->uuid_homestay) }}"  method="POST" >
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Unit</label>
                    <div class="col-sm-10">
                        <input type="hidden" value="8" name="id_unit">
                        <input type="text" value="Homestay" class="form-control" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Homestay</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $value->nama }}" class="form-control" name="nama" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tipe Kamar</label>
                    <div class="col-sm-10">
                        <select name="tipe_kamar" class="form-control" id="" value="{{ $value->tipe_kamar }}" required>
                            <option value="0">-Pilih Tipe Kamar</option>
                            <option value="1" {{ $value->tipe_kamar == 1 ? 'selected' : '' }}>Standard</option>
                            <option value="2" {{ $value->tipe_kamar == 2 ? 'selected' : '' }}>Family Room</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                    <div class="col-sm-10">
                        <input type="date" value="{{ $value->tanggal_masuk }}"  class="form-control" id="tanggal_masuk" name="tanggal_masuk" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal Keluar</label>
                    <div class="col-sm-10">
                        <input type="date" value="{{ $value->tanggal_keluar }}" class="form-control" id="tanggal_keluar" name="tanggal_keluar" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $value->harga }}" class="form-control" name="harga" id="formatrupiah" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Pembeli</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $value->pembeli }}" class="form-control" name="pembeli" required>
                    </div>
                </div>
                <br/>
                <input type="submit" value="Ubah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/homestay') }}">Cancel</a>

           </form>
        </div>
    </div>

</div>
@endsection
