@extends('component.layout')

@section('content')
<div class="container p-4">
    <div class="row mt-4">
        <div class="col-lg-6">
            <h5 class="mb-1">Artefak</h5>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header bg-white">
            <h5>Dokumen Artefak</h5>
        </div>
        <br/>
        <div class="card-body">
            @if(Session::get('jabatan') == '1')

            @else
            <form id="myFileForm" action="/uploadDoc" method="POST" enctype="multipart/form-data">
                @CSRF
                <input type="file" id="myFile" name="filename">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
            <br/>
            @endif
            
            
            <table class="table table-striped" id="logistik">
                <thead>
                    <tr>
                        <td>NO</td>
                        <td>Nama Dokumen</td>
                        <td>Unduh Dokumen</td>
                        <td style="display:none;">total_pemasukan</td>
                    </tr>
                </thead>
                <tbody>
                    @php $no =1; @endphp
                @foreach($list_of_document as $doc)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $doc->nama_dokumen }}</td>   
                    <td>
                        <!-- <form action="{{route('download.document', 
                            [
                            'path'=>base64_encode($doc->file)
                            ]
                            )}}" id="downloadDocument{{ $doc->id_artefak }}" method="POST">
                            </form> -->
                            <!-- @CSRF -->
                            <a href="{{route('download.document', 
                            [
                            'path'=>base64_encode($doc->file)
                            ]
                            )}}">
                            Download
                            </a>
                        
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