@extends('component.layout')

@section('content')
<div class="container p-4">
    <div class="row mt-4">
        <div class="col-lg-6">
            <h5>{{ $title }}</h5>
        </div>
        <div class="col-lg-6">
            @if(Session::get('jabatan') == '4' )
                <a href="{{ url('/administrator/unit-usaha/tambah') }}" class="float-right btn btn-secondary mb-4">Tambah Unit</a>
            @else


            @endif
        </div>
    </div>

    <div class="row">
        @foreach($content as $value)
        <div class="col-lg-6 mb-2">
            <div class="card p-2" style="width:100%;">
                <center><h5 class="p-2">{{ $value->nama_unit }}</h5></center>
                <img class="card-img-top" width="100" height="500" src="{{ $value->image !='' ? URL::to('assets/images/unit-usaha/'.$value->image) : 'http://placehold.it/150' }}" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text" style="text-align:justify">{!! nl2br(e($value->deskripsi)) !!}</p>
                    <div><b>Asset</b>
                        <p class="card-text">{!! nl2br(e($value->aset)) !!}</p>
                    </div>
                    <br />
                    {{-- <div><b>Transaksi</b>

                    <br/> --}}
                    @if(Session::get('jabatan') == '1' )
                    @else
                    <a href= "{!! nl2br(e($value->lapkeg)) !!}" class="btn btn-primary float-">Tambah Transaksi</a>
                    @endif
                    <a href= "{!! nl2br(e($value->lapkeu)) !!}" class="btn btn-secondary text-white">Lihat Transaksi</a>
                    @if(Session::get('jabatan') == '4' )
                        <a href="{{ url('administrator/unit-usaha/ubah/'.$value->unit_uuid); }}" class="btn btn-warning text-white">Ubah</a>
                        <a href="#" data-id="{{ $value->unit_uuid }}" class="btn btn-danger delete" >Hapus</a>
                    @else

                    @endif
                        {{-- </div> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection


@section('javascript')
<script>
    $(".delete").click(function(){
        var uuid = $(this).data('id');
        var token = $("meta[name='csrf-token']").attr("content");

        swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Kamu tidak bisa mengubah kembali!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak, Batal!',
            reverseButtons: true
        }).then(function(result){
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '<?php echo  url("/administrator/unit-usaha/delete"); ?>',
                    type: "POST",
                    data: { "uuid" : uuid},
                    success: function() {
                        swal.fire("Delete!", "", "success");
                        window.location.reload();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal.fire("Error!", "Silahkan coba lagi", "error");
                    }
                });

            } else if (result.dismiss === 'cancel') {
                swal.fire(
                    'Dibatalkan!',
                    'Data kamu aman :)',
                    'error'
                )
            }
        });
    });

</script>
@endsection
