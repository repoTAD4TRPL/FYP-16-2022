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
            <form onsubmit="checkFunction()" action="{{ url('administrator/pegawai/create') }}" enctype="multipart/form-data"   method="POST" >
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="nip" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select name="kelamin" class="form-control" id="" required>
                                    <option value="">Jenis kelamin</option>
                                    <option value="1">Laki Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email"  class="form-control" name="email" required>
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
                            <label for="staticEmail" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select name="id_jabatan" class="form-control" id="" required>
                                    <option value="">Select Unit</option>
                                    @foreach($jabatan as $v_jabatan)
                                        <option value="{{ $v_jabatan->id_jabatan }}">{{ $v_jabatan->nama_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" minlength="4" class="form-control" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-10">
                                <input type="password"  class="form-control" name="password_konfirmasi" id="confirm_password" required>
                                <span id="message"></span>
                                <span id="statue" style="display:none;"></span>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="is_active" class="form-control" id="" required>
                                    <option value="">Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <input type="submit" value="Tambah" class="btn btn-primary float-right">
                        <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/pegawai') }}">Cancel</a>
                    </div>
                    <div class="col-lg-4">
                        <center>
                            <img src="http://placehold.it/150" id="thumbnails_img"  style="width:150px; height:150px;  object-fit: cover;"  alt="">
                        </center>
                        <br/>
                        <input  accept="image/png, image/jpeg, image/jpg"  type="file" name='image' id="image" class="form-control form-control-lg" required>

                    </div>
                </div>
                
                
                

           </form>
        </div>
    </div>
    
</div>
@endsection


@section('javascript')
<script>
    var image = document.getElementById("image");   
    image.onchange = function() {
       
        if(this.files[0].size > 3072000){
           alert("File is too big!");
           this.value = "";
        }
        else{
            if (this.files && this.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#thumbnails_img').attr('src', e.target.result);
              };
              reader.readAsDataURL(this.files[0]);
            }
        }
    };
</script>
<script>
    $('#password, #confirm_password').on('keyup', function () {
    if ($('#password').val() == $('#confirm_password').val()) {
        $('#message').html('Matching').css('color', 'green');
        $("#statue").text('1');
    } else 
        $('#message').html('Not Matching').css('color', 'red');
        $("#statue").text('0');
    });


    function checkFunction(){
        var check = $("#status").text();
        if(check == 1){
            return true;
        } else{
            return false;
        }
    }
</script>

@endsection