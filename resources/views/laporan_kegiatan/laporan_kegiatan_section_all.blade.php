<html>
    <head>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css"> -->
    <style>
        @page { size: A4 }
    
        h1 {
            font-weight: bold;
            font-size: 20pt;
            text-align: center;
        }
    
        table {
            border-collapse: collapse;
            width: 100%;
        }
     
        .table th {
            padding: 8px 8px;
            border:1px solid #000000;
            text-align: center;
        }
    
        .table td {
            padding: 3px 3px;
            border:1px solid #000000;
        }
    
        .text-center {
            text-align: center;
        }

        table#mytable,
        table#mytable td
        {
            border: none !important;
        }
    </style>
    </head>
    <body>
    <section class="sheet padding-10mm">
        <center>
            <img class="mr-2" src="{{ public_path('assets/images/'.$website->logo) }}" width="75" height="75" alt="">
            <span class="ml-2 text-white font-weight-bold" style="font-size:25px;">{{ $website->name }}</span>
        </center>
        <br/>
        <h1>LAPORAN KEGIATAN</h1>
        <br/>
        <br/>
        <h4>Tanggal {{ $from }} - {{ $to }}</h4>
        <table class="table" id="mytable">
            <tr>
                <td>Yth. Bapak Kepala Desa,</td>
            </tr>
            <tr>
                <td>Berikut adalah laporan kegiatan Badan Usaha Milik Desa terhitung sampai tanggal {{ $from }} - {{ $to }}</td>
            </tr>
        </table>
        <br/>
        <h1>LAPORAN KEGIATAN</h1>

        <table class="table">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>Tanggal</td>
                    <td>Lokasi</td>
                    <td>Unit</td>
                    <td>Keterangan</td>
                </tr> 
            </thead>
            <tbody>
                @foreach($content as $index => $value)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $value->tanggal }}</td>
                    <td>{{ $value->lokasi }}</td>
                    <td>{{ $value->nama_unit }}</td>
                    <td>{{ $value->keterangan }}</td>
                </tr>
                @endforeach
              
            </tbody>
        </table>
        

        <br/>
        <br/>
        <br/>
        <table class="table" id="mytable">
            <tr>
                <td style="width:290px;" colspan="10"></td>
                <td>Mengetahui,</td>
             
            </tr>
            <tr>
                <td  style="width:290px;" colspan="10"></td>
                <td>Direktur BUMDes,</td>
            </tr>
            <tr>
                <td style="width:290px;" colspan="10"></td>

                <td>
                <img  src="{{ public_path('assets/images/ttd/'.$admin->file_ttd) }}"  width="75" height="75" alt="">
                </td>
            </tr>   
            <tr>
                <td style="width:290px;" colspan="10"></td>

                <td>{{ $admin->nama }}</td>
            </tr>
        </table>
    </section>
    </body>
</html>