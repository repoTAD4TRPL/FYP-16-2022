@extends('component.layout')

@section('content')
<div class="container p-4">


    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Daftar Pengurus Bumdes</h5>
        </div>
        <div class="card-body">
            @if(Session::get('jabatan') == '1')
            <a href="{{ url('administrator/pegawai/tambah') }}" data-id="" class="btn btn-primary float-right" >Tambah</a>
            <br/>
            <br/>
            @endif


            <table class="table table-striped" id="logistik">
                <thead>
                    <tr>
                        <td>NO</td>
                        <td>Nama</td>
                        <td>Username</td>
                        <td>Jabatan</td>
                        <td>Email</td>
                        <td>Status</td>
                        <td>AKSI</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $index => $value)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->nip }}</td>
                        <td>{{ $value->nama_jabatan }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->is_active == 1 ? 'Active' : 'inactive' }}</td>
                        <td>
                            @if(Session::get('jabatan') == '1')
                            <a href="{{ url('administrator/pegawai/ubah/'.$value->uuid); }}" class="btn btn-warning text-white">Ubah</a>
                            {{-- <a href="#" data-id="{{ $value->uuid }}" class="btn btn-danger delete" >Hapus</a> --}}
                            @endif

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>
@endsection


@section('javascript')

<script>
    var table = $('#logistik').DataTable();

    $(".delete").click(function(){
        var uuid = $(this).data('id');
        var token = $("meta[name='csrf-token']").attr("content");

        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then(function(result){
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '<?php echo  url("/administrator/pegawai/delete"); ?>',
                    type: "POST",
                    data: { "uuid" : uuid},
                    success: function() {
                        swal.fire("Delete!", "", "success");
                        window.location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal.fire("Error Delete!", "Please try again", "error");
                    }
                });

            } else if (result.dismiss === 'cancel') {
                swal.fire(
                    'Cancelled',
                    'Your Data is safe :)',
                    'error'
                )
            }
        });
    });
</script>
@endsection
