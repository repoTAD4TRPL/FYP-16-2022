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
            <form action="{{ url('administrator/toko/update-data/'.$value->uuid_toko) }}"  method="POST" >
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Unit</label>
                    <div class="col-sm-10">
                        <input type="hidden" value="6" name="id_unit">
                        <input type="text" value="Toko" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Unit</label>
                    <div class="col-sm-10">
                        <select name="id_unit" class="form-control" id="" required>
                            <option value="">Select Unit</option>
                            @foreach($unit as $v_unit)
                                <option value="{{ $v_unit->id_unit }}">{{ $v_unit->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea type="text" cols="30" rows="10" class="form-control" name="keterangan" required>{{ $value->keterangan }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date"  class="form-control" value="{{ $value->tanggal }}" name="tanggal" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" value="{{ $value->harga }}" name="harga" id="formatrupiah" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Pembeli</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" value="{{ $value->pembeli }}" name="pembeli" required>
                    </div>
                </div>
                <br/>
                <input type="submit" value="Ubah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/toko') }}">Cancel</a>

           </form>
        </div>
    </div>

</div>
@endsection
