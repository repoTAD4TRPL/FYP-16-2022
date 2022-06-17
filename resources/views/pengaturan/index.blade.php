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
            <form action="{{ url('administrator/pengaturan/update') }}" enctype="multipart/form-data" method="POST" >
                @csrf
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama Website</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $content != '' ? $content->name : '' }}"  class="form-control" name="name" required>
                    </div>
                </div>
              
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-lg-8">
                                <input type="file" name="image" accept="image/png, image/jpeg, image/jpg" class="form-control" {{ $content != '' ? "" : "required" }}>
                            </div>
                            <div class="col-lg-4">
                                <center>
                                    <img src="{{ $content !='' ? URL::to('assets/images/'.$content->logo) : 'http://placehold.it/150' }}" id="thumbnails_img"  style="width:150px; height:150px;  object-fit: cover;"  alt="">
                                </center>
                            </div>
                        </div>
                    </div>
                    
                    
                   
                </div>
                @if(Session::has('update_ok'))
                <div class="alert alert-primary mt-4" role="alert">
                    {{  Session::get('update_ok') }}
                </div>
                @endif
                <br/>
                <input type="submit" value="Simpan" class="btn btn-primary float-right">
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/unit-usaha') }}">Cancel</a>

           </form>
        </div>
    </div>
    
</div>
@endsection
