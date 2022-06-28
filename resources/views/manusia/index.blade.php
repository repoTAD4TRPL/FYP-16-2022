@extends('component.layout')

@section('content')
<div class="container p-4">
    <div class="row mt-4">
        <div class="col-lg-6">
            <h5 class="mb-2">Sumber Daya Manusia</h5>
            <div class="row">
                <div class="col-lg-4">
                    <!-- <div class="form-grop">
                        <label>Dari Tanggal</label>
                        <input type="date" class="form-control" name="filter_to" id="min-date">
                    </div> -->
                </div>
                <!-- <div class="col-lg-5">
                    <div class="form-grop">
                        <label>Ke Tanggal</label>
                        <input type="date" class="form-control" name="filter_from" id="max-date">
                    </div>
                </div> -->
            </div>
        </div>
        <!-- <div class="col-lg-3 text-right">
            <h5 class="mb-2">Total Asset</h5>
            <h5 class="bg-white float-right p-4" id="total_asset" style="border-top:4px solid #f1f1f1;"></h5>
        </div>
        <div class="col-lg-3 text-right">
            <h5 class="mb-2">Total Nilai Asset</h5>
            <h5 class="bg-white float-right p-4" id="total_nilai_asset" style="border-top:4px solid #f1f1f1;"></h5>
        </div> -->
    </div>

    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Informasi Pegawai</h5>
        </div>
        <div class="card-body">
            @if(Session::get('jabatan') == '1' || Session::get('jabatan') == '5' || Session::get('jabatan') == '3' || Session::get('jabatan') == '2')

            @else
            <a href="{{ url('administrator/manusia/tambah') }}" data-id="" class="btn btn-primary float-right" >Tambah</a>
            <br/>
            <br/>
            @endif


            <table class="table table-striped" id="logistik">
                <thead>
                    <tr style="text-align:center" class="font-weight-bold">
                        <td>No</td>
                        <td>Nama</td>
                        <td>Jenis Kelamin</td>
                        <td>Jabatan</td>
                        <td>Tugas</td>
                        <td>Status</td>
                        {{-- <td>Diunggah Oleh</td> --}}
                        <td>Aksi</td>
                        <td style="display:none;">total_pemasukan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $index => $value)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{  $value->kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $value->jabatan }}</td>
                        <td style="text-align:justify">{!! nl2br(e($value->tugas)) !!}</td>
                        <td>{{ $value->is_active == 1 ? 'Active' : 'inactive' }}</td>
                        {{-- <td>{{ $value->upload_by }}</td> --}}

                        <td>
                            @if(Session::get('jabatan') == '1' || Session::get('jabatan') == '5'  || Session::get('jabatan') == '3' || Session::get('jabatan') == '2')

                            @else
                            <a href="{{ url('administrator/manusia/ubah/'.$value->uuid_manusia); }}" class="btn btn-warning text-white">Ubah</a>
                            <a href="#" data-id="{{ $value->uuid_manusia }}" class="btn btn-danger delete" >Hapus</a>
                            @endif

                        </td>
                        <td style="display:none;"></td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>
@endsection


@section('javascript')
<script src="//cdn.datatables.net/plug-ins/1.11.4/api/sum().js"></script>
<script>

    $(document).ready(function() {
        var table = $('#logistik').DataTable({

        });


        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min-date').val();
                var max = $('#max-date').val();
                var createdAt = data[5] || 0; // Our date column in the table
                if (
                (min == "" || max == "") ||
                (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
                ) {
                return true;
                }
                return false;
            }
            );
            // Re-draw the table when the a date range filter changes

            $('#min-date,#max-date').change(function() {
                table.draw();
            });
            table.on( 'draw', function () {
                var total_all   = table.column(8,{"filter": "applied"} ).data().sum();
                var total_asset = table.rows({"filter": "applied"} ).count();

                $("#total_nilai_asset").text("Rp. "+rupiahformat(total_all));
                $("#total_asset").text(total_asset);
            })




    });

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
                    url: '<?php echo  url("/administrator/manusia/delete"); ?>',
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
