@extends('component.layout')

@section('content')
<div class="container p-4">
    <div class="row mt-4">
        <div class="col-lg-6">
            <h5 class="mb-2">Penyewaan Dan Pembelian Barang & Jasa</h5>
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
        <div class="col-lg-2">
            <h5 class="mb-2">Total Penyewaan</h5>
            <h6 class="bg-white float-right p-4" id="total_penyewaan" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($total_penyewaan) }}</h6>
        </div>
        <div class="col-lg-2">
            <h5 class="mb-2">Total Pembelian</h5>
            <h6 class="bg-white float-right p-4" id="total_pembelian" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($total_pembelian) }}</h6>
        </div>
        <div class="col-lg-2">
            <h5 class="mb-2">Total Pemasukan</h5>
            <h6 class="bg-white float-right p-4" id="total_pemasukan" style="border-top:4px solid #f1f1f1;">Rp. {{ number_format($total_penyewaan+$total_pembelian) }}</h6>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Informasi Penyewaan Dan Pembelian</h5>
        </div>
        <div class="card-body">
            @if(Session::get('jabatan') == '1' )

            @else
            <a href="{{ url('administrator/barang-jasa/tambah') }}" data-id="" class="btn btn-primary float-right" >Tambah</a>
            <br/>
            <br/>
            @endif
            
            
            <table class="table table-striped" id="logistik">
                <thead>
                    <tr>
                        <td>NO</td>
                        <td>UNIT</td>
                        <td>JENIS</td>
                        <td>NAMA</td>
                        <td>JUMLAH</td>
                        <td>TANGGAL</td>
                        <td>HARGA</td>
                        <td>AKSI</td>
                        <td style="display:none;">total_penyewaan</td>
                        <td style="display:none;">total_pembelian</td>
                        <td style="display:none;">total_pemasukan</td>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $index => $value)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $value->nama_unit }}</td>
                        <td>{{ $value->jenis == 1 ?  'Sewa' : 'Beli' }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->jumlah }}</td>
                        <td>{{ $value->tanggal }}</td>
                        <td>Rp.{{ number_format($value->harga) }}</td>
                        <td>
                            @if(Session::get('jabatan') == '1' )

                            @else
                            <a href="{{ url('administrator/barang-jasa/ubah/'.$value->uuid_barang_jasa); }}" class="btn btn-warning text-white">Ubah</a>
                            <a href="#" data-id="{{ $value->uuid_barang_jasa }}" class="btn btn-danger delete" >Hapus</a>
                            @endif
                        </td>
                        <td style="display:none;">{{ $value->jenis == 1 ? $value->harga  : 0  }}</td>
                        <td style="display:none;">{{ $value->jenis == 2 ? $value->harga  : 0  }}</td>
                        <td style="display:none;">{{ $total_penyewaan+$total_pembelian }}</td>
           
                       
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
        var table = $('#logistik').DataTable();
       

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

            
            
             
            table.on('draw', function () {
        
                var total_penyewaan = table.column(8,{"filter": "applied"} ).data().sum(); 
                var total_pembelian =  table.column(9,{"filter": "applied"} ).data().sum(); 
                

                $("#total_pemasukan").text("Rp. "+rupiahformat(parseInt(total_penyewaan)+parseInt(total_pembelian)))
                $("#total_penyewaan").text("Rp. "+rupiahformat(total_penyewaan))
                $("#total_pembelian").text("Rp. "+rupiahformat(total_pembelian))
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
                    url: '<?php echo  url("/administrator/barang-jasa/delete"); ?>',
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