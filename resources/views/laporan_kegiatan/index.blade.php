@extends('component.layout')

@section('content')
<div class=" p-4">
    <div class="row mt-4">
        <div class="col-lg-12">
        @if(Session::get('jabatan') == '1')

        @else
            <h5 class="mb-2">Laporan Kegiatan</h5>
            <form method="post" action="{{ url('administrator/laporan-kegiatan/print') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-grop">
                            <label>Dari Tanggal</label>
                            <input type="date" class="form-control" name="filter_from" id="min-date" required>

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-grop">
                            <label>Ke Tanggal</label>
                            <input type="date" class="form-control" name="filter_to" id="max-date" required>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class ="col-lg-4">
                                <label>Cetak</label>
                                <input type="submit" class="btn btn-info" value="Cetak Laporan Kegiatan">
                            </div>
                            <div class ="col-lg-4 align-self-end">
                                <a type="submit" href="/administrator/laporan-kegiatan/mingguan" class="btn btn-info">Cetak Laporan Mingguan</a>
                            </div>
                            <div class ="col-lg-4 align-self-end">
                                <a type="submit" href="/administrator/laporan-kegiatan/bulanan" class="btn btn-info">Cetak Laporan Bulanan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>

    </div>

    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Informasi Laporan Kegiatan</h5>
        </div>
        <div class="card-body">
            @if(Session::get('jabatan') == '1' )

            @elseif(Session::get('jabatan') == '1' || Session::get('jabatan') == '' || Session::get('jabatan') == '')
            {{-- <a href="#import" data-toggle="modal" class="btn btn-success mr-2 float-right" >Import</a> --}}
            @else
            <a href="{{ url('administrator/laporan-kegiatan/tambah') }}" data-id="" class="btn btn-primary float-right" >Tambah</a>
            {{-- <a href="#import" data-toggle="modal" class="btn btn-success mr-2 float-right" >Import</a> --}}
            <br/>
            <br/>
            @endif


            <table class="table table-striped" id="logistik">
                <thead>
                    <tr class="font-weight-bold" style="text-align:center">
                        <td>NO</td>
                        <td>Tanggal</td>
                        <td>Unit</td>
                        <td>Keterangan</td>
                        <td>Lokasi</td>
                        <td>Diunggah Oleh</td>
                        <td>Status</td>

                        <td>Aksi</td>


                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $index => $value)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $value->tanggal }}</td>
                        <td>{{ $value->nama_unit }}</td>
                        <td>{{ $value->keterangan }}</td>
                        <td>{{ $value->lokasi }}</td>
                        <td>{{ $value->upload_by }}</td>
                        <td>
                            @if($value->approve_sekretaris == 0 &&  $value->approve_direktur == 0)
                                Menunggu
                            @elseif($value->approve_sekretaris == 2 || $value->approve_direktur == 2)
                                Ditolak
                            @elseif($value->approve_sekretaris == 1 &&  $value->approve_direktur == 1)
                                Disetujui
                            @else
                                Menunggu
                            @endif

                        </td>
                        <td>
                            @if(Session::get('jabatan') == '1' || Session::get('jabatan') == '' || Session::get('jabatan') == '')

                            @else
                            <a href="{{ url('administrator/laporan-kegiatan/ubah/'.$value->uuid_kegiatan); }}" class="btn btn-warning text-white">Ubah</a>
                            <a href="#" data-id="{{ $value->uuid_kegiatan }}" class="btn btn-danger delete" >Hapus</a>
                            @endif
                            <a href="{{ url('administrator/laporan-kegiatan/detail/'.$value->uuid_kegiatan); }}" class="btn btn-secondary text-white">Detail</a>
                            @if(Session::get('jabatan') == '1' || Session::get('jabatan') == '5' || Session::get('jabatan') == '3' || Session::get('jabatan') == '2' || Session::get('jabatan') == '4')

                                @if($value->approve_sekretaris == 1 && $value->approve_direktur == 1)
                                <a href="{{ url('administrator/laporan-kegiatan/print/'.$value->uuid_kegiatan); }}" class="btn btn-info text-white">Cetak</a>

                                @else
                                <a href="{{ url('administrator/laporan-kegiatan/unapprovedprint/'.$value->uuid_kegiatan); }}" class="btn btn-info text-white">Cetak</a>
                             @endif

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

<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="post" action="{{ url('administrator/laporan-kegiatan/import') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <input type="file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="file" required="required">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script src="//cdn.datatables.net/plug-ins/1.11.4/api/sum().js"></script>
<script>

    $(document).ready(function() {
        var table = $('#logistik').DataTable();


        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min-date').val();
                var max = $('#max-date').val();
                var createdAt = data[1] || 0; // Our date column in the table
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
            cancelButtonText: 'Tidak, Batal!',
            reverseButtons: true
        }).then(function(result){
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '<?php echo  url("/administrator/laporan-kegiatan/delete"); ?>',
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
