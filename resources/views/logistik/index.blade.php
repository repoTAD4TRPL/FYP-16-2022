@extends('component.layout')

@section('content')
<div class="container p-4">
    <div class="row mt-4">
        <div class="col-lg-6">
            <h5 class="mb-2">Laporan Belanja Logistik</h5>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-grop">
                        <label>Dari Tanggal</label>
                        <input type="date"  class="form-control" name="filter_to" id="min-date">
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
        <div class="col-lg-6 text-right">
            <h5 class="mb-2">Total Belanja Logistik</h5>
            <h5 class="bg-white float-right p-4" id="total_logistik" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($total_logistik) }}</h5>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Informasi Logistik</h5>
        </div>
        <div class="card-body">
            @if(Session::get('jabatan') == '1' )

            @else
            <a href="{{ url('administrator/logistik/tambah') }}" data-id="" class="btn btn-primary float-right" >Tambah</a>
            <br/>
            <br/>
            @endif


            <table class="table table-striped" id="logistik">
                <thead>
                    <tr style="text-align:center" class="font-weight-bold">
                        <td>ID Logistik</td>
                        <td>Unit</td>
                        <td>Tanggal</td>
                        <td>Jumlah</td>
                        <td>Keterangan</td>
                        <td>Harga</td>
                        <td>Diunggah Oleh</td>
                        <td>AKSI</td>
                        <td style="display:none;"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $index => $value)
                    <tr>
                        <td>LOG{{ $value->tanggal }}-{{ $index+1 }}</td>
                        @if (isset($value->nama_unit))
                        <td>{{ $value->nama_unit }}</td>
                        @elseif (! (isset($value->nama_unit)))
                        <td>Pusat</td>
                        @endif
                        <td>{{ $value->tanggal }}</td>
                        <td>{{ $value->jumlah }}</td>
                        <td>{{ $value->keterangan }}</td>
                        <td>Rp.{{ number_format($value->harga) }}</td>
                        <td>{{ $value->upload_by }}</td>
                        <td>
                            @if(Session::get('jabatan') == '1' )

                            @else
                            <a href="{{ url('administrator/logistik/ubah/'.$value->uuid_logistik); }}" class="btn btn-warning text-white">Ubah</a>
                            @endif
                            @if(Session::get('jabatan') == '4' )
                            <a href="#" data-id="{{ $value->uuid_logistik }}" class="btn btn-danger delete" >Hapus</a>
                            @else
                            @endif


                        </td>
                        <td style="display:none;">{{ $value->harga }}</td>

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
                var createdAt = data[2] || 0; // Our date column in the table
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
                var total_all = table.column(8,{"filter": "applied"} ).data().sum();
                $("#total_logistik").text("Rp. "+rupiahformat(total_all))
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
                    url: '<?php echo  url("/administrator/logistik/delete"); ?>',
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
