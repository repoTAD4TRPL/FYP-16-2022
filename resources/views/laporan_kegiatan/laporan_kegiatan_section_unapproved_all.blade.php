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
        <table class="table" id="mytable">
            <tr>
                <td>Kepada Yth.
                    <br />
                    Kepala Desa Lumban Gaol <br />
                    Kecamatan Balige
                    <br />
                </td>
            </tr>
            <br />
            <tr>
                <td style="text-align:justify">
                Dengan Hormat,
                <br />
                <br />
                Berdasarkan pelaksanaan kegiatan yang telah dilaksanakan oleh BUMDes Marsingati Lumban Gaol berikut laporan kegiatan BUMDes Marsingati Lumban Gaol terhitung dari tanggal {{ $from }} - {{ $to }}</td>
            </tr>
        </table>
        <br />
        <table class="table">
            <thead>
                <tr style="text-align:center">
                    <td><h3>No</h3></td>
                    <td><h3>Tanggal</h3></td>
                    <td><h3>Lokasi</h3></td>
                    <td><h3>Unit</h3></td>
                    <td><h3>Keterangan</h3></td>
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
                <img  src="{{ public_path('assets/images/ttd/white.png') }}"  width="75" height="75" alt="">
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
