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
        <h1>LAPORAN KEUANGAN</h1>
        <br/>
        <br/>
        <h4>Tanggal {{ $from }} - {{ $to }}</h4>
        <table class="table" id="mytable">
            <tr>
                <td>Yth. Bapak Kepala Desa,</td>
            </tr>
            <tr>
                <td>Berikut adalah laporan keuangan Badan Usaha Milik Desa terhitung sampai tanggal {{ $from }} - {{ $to }}</td>
            </tr>
        </table>
        <br/>
        <h4>Total Keuangan</h4>


        <table class="table">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>Tanggal</td>
                    <td>Jenis</td>
                    <td>Unit</td>
                    <td>Keterangan</td>
                    <td>Nilai</td>
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
                </tr>
                @endforeach
                <tr>
                   <td colspan="5">Pemasukan</td>
                   <td>: Rp. {{ number_format($pemasukan) }}</td>
               </tr>
               <tr>
                   <td colspan="5">Pengeluaran</td>
                   <td>: Rp. {{ number_format($pengeluaran) }}</td>
               </tr>
               <tr>
                   <td colspan="5">Saldo Bumdes</td>
                   <td>: Rp. {{ number_format($pemasukan-$pengeluaran) }}</td>
               </tr>
            </tbody>
        </table>
        <br/>

        <h4>Total Keuangan Logistik</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>Unit</td>
                    <td>Tanggal</td>
                    <td>Jumlah</td>
                    <td>Keterangan</td>
                    <td>Harga</td>
                </tr> 
            </thead>
            <tbody>
                @foreach($content_logistik as $index => $value)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $value->nama_unit }}</td>
                    <td>{{ $value->tanggal }}</td>
                    <td>{{ $value->jumlah }}</td>
                    <td>{{ $value->keterangan }}</td>
                    <td>Rp. {{ number_format($value->harga) }}</td>
                </tr>
                @endforeach
                <tr>
                   <td colspan="5">Total Belanja Logistik</td>
                   <td>: Rp. {{ number_format($total_logistik) }}</td>
               </tr>
               
            </tbody>
        </table>
        <br/>

        <h4>Total Keuangan Barang Jasa</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>Unit</td>
                    <td>Jenis</td>
                    <td>Nama</td>
                    <td>Jumlah</td>
                    <td>Tanggal</td>
                    <td>Harga</td>
                </tr> 
            </thead>
            <tbody>
                @foreach($content_barangjasa as $index => $value)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $value->nama_unit }}</td>
                    <td>{{ $value->jenis == 1 ? 'Sewa' : 'Beli' }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->jumlah }}</td>
                    <td>{{ $value->tanggal }}</td>
                    <td>Rp. {{ number_format($value->harga) }}</td>
                </tr>
                @endforeach
                
                <tr>
                   <td colspan="6">Total Penyewaan</td>
                   <td>: Rp. {{ number_format($total_penyewaan_barangjasa) }}</td>
                </tr>
                <tr>
                   <td colspan="6">Total Pembelian</td>
                   <td>: Rp. {{ number_format($total_pembelian_barangjasa) }}</td>
                </tr>
                <tr>
                   <td colspan="6">Total Pemasukan</td>
                   <td>: Rp. {{ number_format($total_pemasukan_barangjasa) }}</td>
                </tr>
               
            </tbody>
        </table>

        <br/>
        <h4>Total Subsidi Mitra</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>Nama</td>
                    <td>Mitra</td>
                    <td>Jumlah</td>
                    <td>Tanggal</td>
                    <td>Nilai</td>
                </tr> 
            </thead>
            <tbody>
                @foreach($content_bagihasil as $index => $value)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->nama_mitra }}</td>
                    <td>{{ $value->jumlah }}</td>
                    <td>{{ $value->tanggal }}</td>
                    <td>Rp. {{ number_format($value->nilai) }}</td>
                </tr>
                @endforeach
                
                <tr>
                   <td colspan="5">Total Pemasukan Bumdes</td>
                   <td>: Rp. {{ number_format($total_pemasukan_bagihasil) }}</td>
                </tr>
               
               
            </tbody>
        </table>

        <br/>
        <h4>Sumber Daya Barang</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>Nama Barang</td>
                    <td>Nomor Barang</td>
                    <td>Keterangan</td>
                    <td>Tanggal Pembelian</td>
                    <td>Harga Barang</td>
                </tr> 
            </thead>
            <tbody>
                @foreach($content_asset as $index => $value)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $value->nama_asset }}</td>
                    <td>{{ $value->nomor_asset }}</td>
                    <td>{{ $value->keterangan }}</td>
                    <td>{{ $value->tanggal_terdaftar }}</td>
                    <td>Rp. {{ number_format($value->nilai_asset) }}</td>
                </tr>
                @endforeach
                <tr>
                   <td colspan="5">Total Nilai Asset</td>
                   <td>: Rp. {{ number_format($total_asset) }}</td>
                </tr>
               
               
            </tbody>
        </table>

        
        <!-- newtab -->
        <!-- BARANG JASA = PEMASUKAN  $barang_jasa_pemasukan-->
        <!-- LOGISTIK PENGELUARAN $logistik_pengeluaran -->
        <br/>
        <h4>Laporan Laba/Rugi</h4>
        <table class="table">
            <thead>
                <tr>
                    <td>NO</td>
                    <td>Keterangan</td>
                    <td>Nilai</td>
                </tr> 
            </thead>
            <tbody>
                <?php 
                    $pemasukan_all  = $pemasukan+$barang_jasa_pemasukan_total;
                    $pengeluaran_all= $pengeluaran+$logistik_pengeluaran_total;
                    $total_saldo    = $pemasukan_all-$pengeluaran_all;

                    $array_pengeluaran_logistik     = array();
                    $array_pengeluaran_keuangan     = array();

                    foreach($logistik_pengeluaran as $value){
                        $array_pengeluaran_logistik[] = array(
                            'keterangan'    => $value->keterangan,
                            'nilai'         => 'Rp. '.number_format($value->harga)
                        );
                    }

                    foreach($pengeluaran_list as $value){
                        $array_pengeluaran_keuangan[] = array(
                            'keterangan'    => $value->keterangan,
                            'nilai'         => 'Rp. '.number_format($value->nilai)
                        );
                    }

                    $combine    = array_merge($array_pengeluaran_logistik, $array_pengeluaran_keuangan );
                ?>



                @foreach($combine as $index => $value)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $value['keterangan'] }}</td>
                    <td>{{ $value['nilai'] }}</td>
                </tr>
                @endforeach

        
                <tr>
                   <td colspan="2">Total Pemasukan</td>
                   <td>: Rp. {{ number_format($pemasukan_all) }}</td>
               </tr>
                <tr>
                   <td colspan="2">Total Pengeluaran</td>
                   <td>: Rp. {{ number_format($pengeluaran_all) }}</td>
                </tr>
                <tr>
                   <td colspan="2">Laba bersih</td>
                   <td>: Rp. {{ number_format($total_saldo); }}</td>
                </tr>
                <!--                 
                <tr>
                   <td colspan="5">Pemasukan</td>
                   <td>: Rp. {{ number_format($pemasukan) }}</td>
               </tr>
               <tr>
                   <td colspan="5">Pengeluaran</td>
                   <td>: Rp. {{ number_format($pengeluaran) }}</td>
               </tr>
               <tr>
                   <td colspan="5">Saldo Bumdes</td>
                   <td>: Rp. {{ number_format($pemasukan-$pengeluaran) }}</td>
               </tr> -->
               
            </tbody>
        </table>
        <!-- endnewtab -->

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