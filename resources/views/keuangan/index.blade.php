@extends('component.layout')

@section('content')
<div class="container p-4">
    <div class="row mt-4">
        <div class="col-lg-6">
            <h5 class="mb-2">Keuangan</h5>
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
        <?php
            $pemasukan_all  = $pemasukan+$pemasukantoko+$pemasukanhomestay+$pemasukan_keuangan;
            $pengeluaran_all= $pengeluaran+$pengeluaran_keuangan;
            $total_saldo    = $pemasukan_all-$pengeluaran_all;
        ?>
        <div class="col-lg-2 text-right">
            <h6 class="mb-2">Total Pemasukan</h6>
            <h5 class="bg-white float-right p-4" id="total_pemasukan" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($pemasukan_all) }}</h5>
        </div>
        <div class="col-lg-2 text-right">
            <h6 class="mb-2">Total Pengeluaran</h6>
            <h5 class="bg-white float-right p-4" id="total_pengeluaran" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($pengeluaran_all) }}</h5>
        </div>
        <div class="col-lg-2 text-right">
            <h6 class="mb-2"><?= $pemasukan_all > $pengeluaran_all ? 'Total Laba' : 'Total Rugi'; ?></h6>
            <h5 class="bg-white float-right p-4" id="total_saldo" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($total_saldo) }}</h5>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Informasi Keuangan</h5>
        </div>
        <div class="card-body">
            @if(Session::get('jabatan') == '1')

            @else
            <a href="{{ url('administrator/keuangan/tambah') }}" data-id="" class="btn btn-primary float-right" >Tambah</a>
            <br/>
            <br/>
            @endif


            <table class="table table-striped" id="logistik">
                <thead>
                    <tr class="font-weight-bold" style="text-align:center">
                        <td>NO</td>
                        <td>Tanggal</td>
                        <td>Jenis</td>
                        <td>Unit</td>
                        <td>Keterangan</td>
                        <td>Nilai</td>
                        <td>Diunggah Oleh</td>
                        <td>Aksi</td>
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
                        <td>{{ $value->upload_by }}</td>

                        <td>
                            @if(Session::get('jabatan') == '5' || Session::get('jabatan') == '4' || Session::get('jabatan') == '3' || Session::get('jabatan') == '2')
                                <a href="{{ url('administrator/keuangan/ubah/'.$value->uuid_keuangan); }}" class="btn btn-warning text-white">Ubah</a>
                                <a href="#" data-id="{{ $value->uuid_keuangan }}" class="btn btn-danger delete" >Hapus</a>
                            @else

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
            table.on('draw', function () {
                var pemasukan   = table.column(8,{"filter": "applied"} ).data().sum();
                var pengeluaran   = table.column(9,{"filter": "applied"} ).data().sum();
                // var  = table.rows({"filter": "applied"} ).count();

                $("#total_pemasukan").text("Rp. "+rupiahformat(pemasukan));
                $("#total_pengeluaran").text("Rp. "+rupiahformat(pengeluaran));
                $("#total_saldo").text("Rp. "+rupiahformat(parseInt(pemasukan)-parseInt(pengeluaran)));


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
                    url: '<?php echo  url("/administrator/keuangan/delete"); ?>',
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
