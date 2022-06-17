@extends('component.layout')

@section('content')
<div class="container p-4">
    

    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Grafik Keuangan</h5>
            <br/>
           
            <?php
                $already_selected_value = date('Y');
                $earliest_year = 2005;
                print '<select  id="year_slc" class="form-control">';
                foreach (range(date('Y'), $earliest_year) as $x) {
                    print '<option '.($x == $year ? ' selected="selected"' : '').' value="'.url("administrator/asset-keuangan-grafik/".$x).'">'.$x.'</a></option>';
                }
                print '</select>';
            ?>
            
        </div>
        <div class="card-body">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    
    
</div>
@endsection


@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $("#year_slc").on('change',function(){
    
        window.location.href = $("#year_slc").val();
    })

    var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["Januari" ,"Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
				datasets: [
                    {
					label: "Grafik {{ $year }} Pemasukan",
					data: [
                        <?php 
                            for ($month = 1; $month <= 12; $month++) {
                                $pemasukan = DB::table('keuangan')->whereYear('tanggal','=',$year)->whereMonth('tanggal','=',$month)->where(['jenis' => 1, 'status' => 1, ])->get();
                                $ttl_data = 0;
                                foreach($pemasukan as $v_pemasukan){
                                    $ttl_data+= $v_pemasukan->nilai;
                                }
                                echo $ttl_data.',';
                            }
                        ?>
                    ],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
					borderWidth: 1
				},
                {
					label: "Grafik {{ $year }} Pengeluaran",
					data: [
                        <?php 
                            for ($month = 1; $month <= 12; $month++) {
                                $pengeluaran = DB::table('keuangan')->whereYear('tanggal','=',$year)->whereMonth('tanggal','=',$month)->where(['jenis' => 2, 'status' => 1, ])->get();
                                $ttl_data = 0;
                                foreach($pengeluaran as $v_pengeluaran){
                                    $ttl_data+= $v_pengeluaran->nilai;
                                }
                                echo $ttl_data.',';
                            }
                        ?>
                    ],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
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