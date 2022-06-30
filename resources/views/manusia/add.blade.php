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
            <form action="{{ url('administrator/manusia/create') }}"  method="POST" >
                @csrf

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
                            <label for="staticEmail" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <input type="text"  class="form-control" name="jabatan" required>
                            </div>
                        </div>
                        <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Tugas</label>
                    <div class="col-sm-10">
                        <textarea name="tugas" class="form-control" id="" cols="30" rows="10" required></textarea>
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
                <a class="btn btn-secondary float-right mr-2" href="{{ url('administrator/manusia') }}">Cancel</a>

           </form>
        </div>
    </div>

</div>
@endsection
