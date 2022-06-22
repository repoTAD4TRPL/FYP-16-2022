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
            <form action="{{ url('administrator/laporan-kegiatan/update-data/'.$value->uuid_kegiatan) }}"  method="POST" >
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        {{ $value->tanggal }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Unit</label>
                    <div class="col-sm-10">
                        {{ $unit->nama_unit }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Lokasi</label>
                    <div class="col-sm-10">
                        {{ $value->lokasi }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        {{ $value->keterangan }}
                    </div>
                </div>
                @if(Session::has('update_ok'))
                <div class="alert alert-primary mt-4" role="alert">
                    {{  Session::get('update_ok') }}
                </div>
                @endif
                <br/>
                @if(Session::get('jabatan') == '2')
                <!-- SEKRETARIS -->
                    @if($value->approve_sekretaris == 0)
                    <a href="{{ url('administrator/laporan-kegiatan/sekretaris/setuju/'.$value->uuid_kegiatan) }}" class="btn btn-info float-right mr-2">Setuju</a>
                    <a href="{{ url('administrator/laporan-kegiatan/sekretaris/tolak/'.$value->uuid_kegiatan) }}" class="btn btn-danger float-right mr-2">Tolak</a>
                    @endif
                @elseif(Session::get('jabatan') == '3')
                <!-- BENDAHARA -->
                    @if($value->approve_sekretaris == 1)

                    @endif
                @elseif(Session::get('jabatan') == '4')
                <!-- DIREKTUR -->
                    @if($value->approve_sekretaris == 1)
                        @if($value->approve_direktur == 0)
                        <a href="{{ url('administrator/laporan-kegiatan/direktur/setuju/'.$value->uuid_kegiatan) }}" class="btn btn-info float-right mr-2">Setuju</a>
                        <a href="{{ url('administrator/laporan-kegiatan/direktur/tolak/'.$value->uuid_kegiatan) }}" class="btn btn-danger float-right mr-2">Tolak</a>
                        @endif
                    @endif
                @else
                @endif
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/laporan-kegiatan') }}">Cancel</a>

           </form>
        </div>
    </div>

</div>
@endsection
