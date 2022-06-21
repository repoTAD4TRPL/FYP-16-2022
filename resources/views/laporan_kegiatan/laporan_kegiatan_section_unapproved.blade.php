<html>
    <head>
    <style>

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

            text-align: center;
        }

        .table td {
            padding: 3px 3px;

        }

        .text-center {
            text-align: center;
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
                Berdasarkan pelaksanaan kegiatan yang telah dilaksanakan oleh BUMDes Marsingati Lumban Gaol berikut laporan kegiatan BUMDes Marsingati Lumban Gaol:</td>
            </tr>
        </table>
        <br/>
        <br/>
        <table class="table">

            <tr>
                <td >Tanggal</td>
                <td>: {{ $content->tanggal }} </td>
            </tr>

            <tr>
                <td>Lokasi</td>
                <td>: {{ $content->lokasi }} </td>
            </tr>

            <tr>
                <td>Unit</td>
                <td>: {{ $unit->nama_unit }}</td>
            </tr>
            <tr>
                <td >Keterangan</td>
                <td>: {{ $content->keterangan }}</td>
            </tr>

        </table>
        <br/>
        <br/>
        <br/>
        <br/>
        <table class="table" >
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
