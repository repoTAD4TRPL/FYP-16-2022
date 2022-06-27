@extends('component.layout')

@section('content')

<div class="container p-4">
    <div class="row">
        <div class="col-lg-4 text-right">
            <h6 class="mb-2">Total Pemasukan Barang & Jasa {{ $year }}</h6>
            <h5 class="bg-white float-right p-4" id="total_pemasukan" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($barang_jasa+$toko+$homestay) }}</h5>
        </div>
        <div class="col-lg-4 text-right">
            <h6 class="mb-2">Total Sumber Daya {{ $year }}</h6>
            <h5 class="bg-white float-right p-4" id="total_pengeluaran" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($asset) }}</h5>
        </div>
        <div class="col-lg-4 text-right">
            <h6 class="mb-2">Subsidi Mitra {{ $year }}</h6>
            <h5 class="bg-white float-right p-4" id="total_saldo" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($hasil_usaha) }}</h5>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Grafik Keuangan</h5>
            <br/>
            <form action="{{ url('administrator/dashboard') }}" method="get">
            <div class="row">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <?php
                                $already_selected_value = date('Y');
                                $earliest_year = 2005;
                                print '<select  id="year_slc" name="year" class="form-control">';
                                foreach (range(date('Y'), $earliest_year) as $x) {
                                    print '<option '.($x == $year ? ' selected="selected"' : '').' value="'.$x.'">'.$x.'</a></option>';
                                }
                                print '</select>';
                            ?>
                        </div>
                        <div class="col-lg-4">
                            <input type="submit" class="btn btn-info" value="Tampilkan Data">
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </div>
        <div class="card-body">
            <canvas id="myChart"></canvas>
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
                    url: '<?php echo  url("/administrator/programkerja/delete"); ?>',
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

    var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Januari" ,"Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
				datasets: [
                {
					label: "Total Pemasukan Barang & Jasa {{ $year }}",
					data: [
                        <?php
                            for ($month = 1; $month <= 12; $month++) {
                                $barangjasa = DB::table('barang_jasa')->whereYear('tanggal','=',$year)->whereMonth('tanggal','=',$month)->where(['status' => 1])->get();
                                $ttl_data = 0;
                                foreach($barangjasa as $v_barangjasa){
                                    $ttl_data+= $v_barangjasa->harga;
                                }
                                echo $ttl_data.',';
                            }
                        ?>
                    ],
					backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
					],
					borderColor: [
                        'rgba(255,99,132,1)'
					],
					borderWidth: 1
				},
                {
					label: "Total Asset {{ $year }}",
					data: [
                        <?php
                            for ($month = 1; $month <= 12; $month++) {
                                $asset = DB::table('asset')->whereYear('tanggal_terdaftar','=',$year)->whereMonth('tanggal_terdaftar','=',$month)->where(['status' => 1])->get();
                                $ttl_data = 0;
                                foreach($asset as $v_asset){
                                    $ttl_data+= $v_asset->nilai_asset;
                                }
                                echo $ttl_data.',';
                            }
                        ?>
                    ],
					backgroundColor: [
                        'rgba(54, 162, 235, 0.2)'
					],
					borderColor: [
                        'rgba(54, 162, 235, 0.2)'
					],
					borderWidth: 1
				},
                {
					label: "Subdisi Mitra {{ $year }}",
					data: [
                        <?php
                            for ($month = 1; $month <= 12; $month++) {
                                $bagihasilush = DB::table('bagi_hasil_usaha')->whereYear('tanggal','=',$year)->whereMonth('tanggal','=',$month)->where(['status' => 1, 'status_hasil' => 1])->get();
                                $ttl_data = 0;
                                foreach($bagihasilush as $v_bagihasilush){
                                    $ttl_data+= $v_bagihasilush->nilai;
                                }
                                echo $ttl_data.',';
                            }
                        ?>
                    ],
					backgroundColor: [
                        'rgba(255, 206, 86, 0.2)'
					],
					borderColor: [
                        'rgba(255, 206, 86, 0.2)'
					],
					borderWidth: 1
				}
            ]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
</script>

@endsection
