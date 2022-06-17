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
            <form action="{{ url('administrator/keuangan/create') }}"  method="POST" >
                @csrf
               
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date"  class="form-control" name="tanggal" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        <select name="jenis" class="form-control" id="" required>
                            <option value="">Jenis</option>
                            <option value="1">Pemasukan</option>
                            <option value="2">Pengeluaran</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Unit</label>
                    <div class="col-sm-10">
                        <select name="id_unit" class="form-control" id="" required>
                            <option value="">Unit</option>
                            @foreach($unit as $v_unit)
                                <option value="{{ $v_unit->id_unit }}">{{ $v_unit->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nilai</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" name="nilai"  id="formatrupiah"  required> 
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Saldo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="saldo_akhir" id="formatrupiah2" required> 
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" class="form-control" id="" cols="30" rows="10" required></textarea>
                    </div>
                </div>
               
                <br/>
                <input type="submit" value="Tambah" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/keuangan') }}">Cancel</a>

           </form>
        </div>
    </div>
    
</div>
@endsection
