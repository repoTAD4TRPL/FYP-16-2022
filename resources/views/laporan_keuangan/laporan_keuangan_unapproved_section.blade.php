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
        <h1>LAPORAN KEUANGAN</h1>
        <br/>
        <br/>
        <table class="table">
            <tr>
                <td>Yth. Bapak Kepala Desa,</td>
            </tr>
            <tr>
                <td>Berikut adalah laporan keuangan Badan Usaha Milik Desa terhitung sampai tanggal {{ $content->tanggal }}</td>
            </tr>
        </table>
        <br/>
        <br/>
        <table class="table">
        <?php 
                $pemasukan_all  = $pemasukan+$pemasukan_keuangan;
                $pengeluaran_all= $pengeluaran+$pengeluaran_keuangan;
                $total_saldo    = $pemasukan_all-$pengeluaran_all;
            ?>
            <tr>
                <td >Tanggal</td>
                <td>: {{ $content->tanggal }} </td>
            </tr>
            <tr>
                <td >Jenis</td>
                <td>: {{ $content->jenis == 1 ? 'Pemasukan' : 'Pengeluaran' }}</td>
            </tr>
            <tr>
                <td>Nilai</td>
                <td>: Rp. {{ number_format($content->nilai) }} </td>
            </tr> 
            <tr>
                <td >Saldo Akhir</td>
                <td>: Rp. {{ number_format($total_saldo) }}</td>
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