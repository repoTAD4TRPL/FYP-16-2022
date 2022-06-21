@extends('component.layout')

@section('content')
<div class="container p-4">
    <div class="row mt-4">
        <div class="col-lg-6">
            <h5 class="mb-2">Subsidi Mitra</h5>
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
        <div class="col-lg-6 text-right">
            <h5 class="mb-2">Total Pemasukan Bumdes</h5>
            <h5 class="bg-white float-right p-4" id="total_pemasukan" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($total_pemasukan) }}</h5>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Informasi Subsidi Mitra</h5>
        </div>
        <div class="card-body">
            @if(Session::get('jabatan') == '4')
            <a href="{{ url('administrator/bagi-hasil-usaha/tambah') }}" data-id="" class="btn btn-primary float-right" >Tambah</a>
            @else

            <br/>
            <br/>
            @endif


            <table class="table table-striped" id="logistik">
                <thead>
                    <tr class="font-weight-bold" style="text-align:center">
                        <td>No</td>
                        <td>Jenis Subsidi</td>
                        <td>Nama</td>
                        <td>Mitra</td>
                        <td>Jumlah</td>
                        <td>Tanggal</td>
                        <td>Nilai</td>
                        <td>Status</td>
                        <td>Diunggah Oleh</td>
                        <td>Aksi</td>
                        <td style="display:none;">total_pemasukan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $index => $value)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $value->jenis_bagi_hasil }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->nama_mitra }}</td>
                        <td>{{ $value->jumlah }}</td>
                        <td>{{ $value->tanggal }}</td>
                        <td>Rp. {{ number_format($value->nilai) }}</td>
                        <td>{{ $value->upload_by }}</td>
                        <td>
                            @if($value->status_hasil == 1)
                                Success
                            @elseif($value->status_hasil == 2)
                                On Process
                            @else
                                Failed
                            @endif

                        </td>
                        <td>
                            @if(Session::get('jabatan') == '4')
                                <a href="{{ url('administrator/bagi-hasil-usaha/ubah/'.$value->uuid_bagi_hasil); }}" class="btn btn-warning text-white">Ubah</a>
                                <a href="#" data-id="{{ $value->uuid_bagi_hasil }}" class="btn btn-danger delete" >Hapus</a>
                            @else

                            @endif
                        </td>
                        <td style="display:none;">{{ $value->status_hasil == 1 ? $value->nilai : 0 }}</td>


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
                var total_all = table.column(9,{"filter": "applied"} ).data().sum();
                $("#total_pemasukan").text("Rp. "+rupiahformat(total_all));
            })




    });

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
                    url: '<?php echo  url("/administrator/bagi-hasil-usaha/delete"); ?>',
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
