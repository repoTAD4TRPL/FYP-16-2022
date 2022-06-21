@extends('component.layout')

@section('content')
<div class="p-4">
    <div class="row mt-4">
        <div class="col-lg-4">
            <?php
                $pemasukan_all  = $pemasukan+$pemasukan_keuangan;
                $pengeluaran_all= $pengeluaran+$pengeluaran_keuangan;
                $total_saldo    = $pemasukan_all-$pengeluaran_all;
            ?>
            <h5 class="mb-2">Saldo Bumdes</h5>
            <h5 class="bg-white p-4" id="total_saldo" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($total_saldo) }}</h5>
        </div>
        <div class="col-lg-8">
            @if(Session::get('jabatan') == '1')

            @else
            <form method="post" action="{{ url('administrator/laporan-keuangan/print') }}">
            <div class="container">
                <h5 class="mb-2">Laporan Keuangan</h5>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-grop">
                                    <label>Dari Tanggal</label>
                                    <input type="date" class="form-control" name="filter_from" id="min-date" required> </br>
                                    <a type="submit" href="/administrator/laporan-keuangan/mingguan" class="btn btn-info">Cetak Laporan Mingguan</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-grop">
                                    <label>Ke Tanggal</label>
                                    <input type="date" class="form-control" name="filter_to" id="max-date" required> </br>
                                    <a type="submit" href="/administrator/laporan-keuangan/bulanan" class="btn btn-info"> Cetak Laporan Bulanan </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Cetak</label>
                        <input type="submit" class="btn btn-info" value="Cetak Laporan Keuangan">


                    </div>
                </div>
            </div>
            </form>
            @endif

        </div>

    </div>

    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Informasi Laporan Keuangan</h5>
        </div>
        <div class="card-body">
            @if(Session::get('jabatan') == '1')

            @elseif(Session::get('jabatan') == '3' || Session::get('jabatan') == '2' || Session::get('jabatan') == '4')
            <a href="#import" data-toggle="modal" class="btn btn-success mr-2 float-right" >Import</a>
            @else
            <a href="#import" data-toggle="modal" class="btn btn-success mr-2 float-right" >Import</a>
            <br/>
            <br/>
            @endif

            <table class="table table-striped" id="logistik">
                <thead>
                    <tr class="font-weight-bold" style="text-align:center">
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Jenis</td>
                        <td>Unit</td>
                        <td>Keterangan</td>
                        <td>Nilai</td>
                        <td>Status</td>
                        <td>AKSI</td>
                        <td style="display:none;">total_pemasukan</td>
                        <td style="display:none;">total_pengeluaran</td>
                        <td style="display:none;">total_saldo</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $index => $value)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $value->tanggal }}</td>
                        <td>{{ $value->jenis == 1 ? 'Pemasukan' : 'Pengeluaran' }}</td>
                        <td>{{ $value->nama_unit }}</td>
                        <td>{{ $value->keterangan }}</td>
                        <td>Rp. {{ number_format($value->nilai) }}</td>
                        <td>
                            <!-- Sekretaris, Bendahara, Direktur  -->
                            @if($value->approve_sekretaris == 0 && $value->approve_bendahara == 0 && $value->approve_direktur == 0)
                                Menunggu
                            @elseif($value->approve_sekretaris == 2 || $value->approve_bendahara == 2 || $value->approve_direktur == 2)
                                Ditolak
                            @elseif($value->approve_sekretaris == 1 && $value->approve_bendahara == 1 && $value->approve_direktur == 1)
                                Disetujui
                            @else
                                Menunggu
                            @endif
                        </td>
                        <td>
                            @if(Session::get('jabatan') == '1' || Session::get('jabatan') == '' || Session::get('jabatan') == '' || Session::get('jabatan') == '')
                                @if($value->approve_sekretaris == 0 && $value->approve_bendahara == 0)

                                @else
                                @endif
                            @else
                            <!-- <a href="{{ url('administrator/keuangan/ubah/'.$value->uuid_keuangan); }}" class="btn btn-warning text-white">Ubah</a>
                            <a href="#" data-id="{{ $value->uuid_keuangan }}" class="btn btn-danger delete" >Hapus</a> -->
                            @endif
                            <a href="{{ url('administrator/keuangan/detail/'.$value->uuid_keuangan); }}" class="btn btn-secondary text-white">Detail</a>
                            @if($value->approve_sekretaris == 1 && $value->approve_bendahara == 1 && $value->approve_direktur == 1)
                                @if(Session::get('jabatan') == '1' || Session::get('jabatan') == '' || Session::get('jabatan') == '')
                                @else
                                <a href="{{ url('administrator/keuangan/print/'.$value->uuid_keuangan); }}" class="btn btn-info text-white">Cetak</a>
                                @endif
                            @else
                                <a href="{{ url('administrator/keuangan/unapprovedprint/'.$value->uuid_keuangan); }}" class="btn btn-info text-white">Cetak</a>
                            @endif

                        </td>
                        <td style="display:none;">{{ $value->jenis == 1 ? $value->nilai : 0 }}</td>
                        <td style="display:none;">{{ $value->jenis == 2 ? $value->nilai : 0}}</td>
                        <td style="display:none;">{{ $pemasukan-$pengeluaran }}</td>
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
        <form method="post" action="{{ url('administrator/laporan-keuangan/import') }}" enctype="multipart/form-data">
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
        var table = $('#logistik').DataTable({

        });


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
            table.on( 'draw', function () {
                var pemasukan   = table.column(8,{"filter": "applied"} ).data().sum();
                var pengeluaran   = table.column(9,{"filter": "applied"} ).data().sum();
                // var  = table.rows({"filter": "applied"} ).count();

                $("#total_saldo").text("Rp. "+rupiahformat(parseInt(pemasukan)-parseInt(pengeluaran)));
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
                    url: '<?php echo  url("/administrator/keuangan/delete"); ?>',
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
