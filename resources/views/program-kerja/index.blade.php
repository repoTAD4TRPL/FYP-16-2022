@extends('component.layout')

@section('content')
<div class="container p-4">
    <div class="row mt-4">
        <div class="col-lg-6">
            <h5 class="mb-2">Rencana Program Kerja</h5>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-grop">
                        <label>Dari Tanggal</label>
                        <input type="date" class="form-control" name="filter_to" id="min-date">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-grop">
                        <label>Ke Tanggal</label>
                        <input type="date" class="form-control" name="filter_from" id="max-date">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Rencana Program Kerja</h5>
        </div>
        <div class="card-body">
            @if(Session::get('jabatan') == '1' || Session::get('jabatan') == '5' || Session::get('jabatan') == '3' || Session::get('jabatan') == '2')

            @else
            <a href="{{ url('administrator/program-kerja/tambah') }}" data-id="" class="btn btn-primary float-right" >Tambah</a>
            <br/>
            <br/>
            @endif


            <table class="table table-striped" id="dashboard">
                <thead>
                    <tr class="font-weight-bold" style="text-align:center">
                        <td>NO</td>
                        <td>Program</td>
                        <td>Kegiatan</td>
                        <td>Anggaran</td>
                        <td>Sumber</td>
                        <td>Output</td>
                        <td>Indikator Success</td>
                        <td>Waktu Pelaksanaan</td>
                        <td>AKSI</td>
                        <td style="display:none;">Anggaran</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $index => $value)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $value->program }}</td>
                        <td style="text-align:justify">{!! nl2br(e($value->kegiatan)) !!}</td>
                        <td>Rp. {{ number_format($value->anggaran) }}</td>
                        <td>{{ $value->sumber}}</td>
                        <td>{{ $value->output }}</td>
                        <td style="text-align:justify">{!! nl2br(e($value->indikator)) !!}</td>
                        <td>{{ $value->waktu }}</td>

                        <td>
                            @if(Session::get('jabatan') == '1' || Session::get('jabatan') == '5'  || Session::get('jabatan') == '3' || Session::get('jabatan') == '2')

                            @else
                            <a href="{{ url('administrator/program-kerja/ubah/'.$value->uuid_pk); }}" class="btn btn-warning text-white">Ubah</a>
                            <a href="#" data-id="{{ $value->uuid_pk }}" class="btn btn-danger delete" >Hapus</a>
                            @endif

                        </td>
                        <td style="display:none;">{{ $value->anggaran }}</td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



</div>
@endsection


@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.11.4/api/sum().js"></script>
<script>

  $(document).ready(function() {
        var table = $('#dashboard').DataTable({

        });


        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min-date').val();
                var max = $('#max-date').val();
                var createdAt = data[7] || 0; // Our date column in the table
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
            cancelButtonText: 'Tidak, Cancel!',
            reverseButtons: true
        }).then(function(result){
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '<?php echo  url("/administrator/program-kerja/delete"); ?>',
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
                    'Cancelled',
                    'Data kamu aman :)',
                    'error'
                )
            }
        });
    });


</script>

@endsection
