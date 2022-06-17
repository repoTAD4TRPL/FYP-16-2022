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
            <form action="{{ url('administrator/keuangan/update-data/'.$value->uuid_keuangan) }}"  method="POST" >
                @csrf
               
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                     {{ $value->tanggal }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10">
                        {{ $value->jenis == 1 ? 'Pemasukan' : 'Pengeluaran' }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Unit</label>
                    <div class="col-sm-10">
                       {{ $unit->nama_unit }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nilai</label>
                    <div class="col-sm-10">
                        Rp. {{ number_format($value->nilai) }}
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
                    <a href="{{ url('administrator/keuangan/sekretaris/setuju/'.$value->uuid_keuangan) }}" class="btn btn-info float-right mr-2">Setuju</a>
                    <a href="{{ url('administrator/keuangan/sekretaris/tolak/'.$value->uuid_keuangan) }}" class="btn btn-danger float-right mr-2">Tolak</a>
                    @endif    
                @elseif(Session::get('jabatan') == '3')
                <!-- BENDAHARA -->
                    @if($value->approve_sekretaris == 1)
                        @if($value->approve_bendahara == 0)
                        <a href="{{ url('administrator/keuangan/bendahara/setuju/'.$value->uuid_keuangan) }}" class="btn btn-info float-right mr-2">Setuju</a>
                        <a href="{{ url('administrator/keuangan/bendahara/tolak/'.$value->uuid_keuangan) }}" class="btn btn-danger float-right mr-2">Tolak</a>
                        @endif
                    @endif
                @elseif(Session::get('jabatan') == '4')
                <!-- DIREKTUR -->
                    @if($value->approve_sekretaris == 1 && $value->approve_bendahara == 1) 
                        @if($value->approve_direktur == 0)
                        <a href="{{ url('administrator/keuangan/direktur/setuju/'.$value->uuid_keuangan) }}" class="btn btn-info float-right mr-2">Setuju</a>
                        <a href="{{ url('administrator/keuangan/direktur/tolak/'.$value->uuid_keuangan) }}" class="btn btn-danger float-right mr-2">Tolak</a>
                        @endif
                    @endif
                @else

                @endif
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/laporan-keuangan') }}">Cancel</a>

           </form>
        </div>
    </div>
    
</div>
@endsection
