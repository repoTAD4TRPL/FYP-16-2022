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
        <!-- <h4>Tanggal {{ $from }} - {{ $to }}</h4> -->
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
                Berdasarkan pelaksanaan kegiatan yang telah dilaksanakan oleh BUMDes Marsingati Lumban Gaol berikut laporan keuangan BUMDes Marsingati Lumban Gaol terhitung dari tanggal {{ $from }} - {{ $to }}</td>
            </tr>
        </table>
        <br/>
        <h4>Total Keuangan</h4>


        <table class="table">
            <thead>
                <tr class="font-weight-bold" style="text-align:center">
                    <td><b>No</b></td>
                    <td><b>Tanggal</b></td>
                    <td><b>Jenis</b></td>
                    <td><b>Unit</b></td>
                    <td><b>Keterangan</b></td>
                    <td><b>Nilai</b></td>
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
                   <td colspan="5"><b>Pemasukan</b></td>
                   <td>: Rp. {{ number_format($pemasukan) }}</td>
               </tr>
               <tr>
                   <td colspan="5"><b>Pengeluaran</b></td>
                   <td>: Rp. {{ number_format($pengeluaran) }}</td>
               </tr>

            </tbody>
        </table>
        <br/>

        <h4>Total Keuangan Logistik</h4>
        <table class="table">
            <thead>
                <tr class="font-weight-bold" style="text-align:center">
                    <td><b>No</b></td>
                    <td><b>Unit</b></td>
                    <td><b>Tanggal</b></td>
                    <td><b>Jumlah</b></td>
                    <td><b>Keterangan</b></td>
                    <td><b>Harga</b></td>
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
                   <td colspan="5"><b>Total Belanja Logistik</b></td>
                   <td>: Rp. {{ number_format($total_logistik) }}</td>
               </tr>

            </tbody>
        </table>
        <br/>

        <h4>Total Transaksi Barang Jasa</h4>
        <table class="table">
            <thead>
                <tr class="font-weight-bold" style="text-align:center">
                    <td><b>No</b></td>
                    <td><b>Unit</b></td>
                    <td><b>Jenis</b></td>
                    <td><b>Nama</b></td>
                    <td><b>Jumlah</b></td>
                    <td><b>Tanggal</b></td>
                    <td><b>Harga</b></td>
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
                   <td colspan="6"><b>Total Penyewaan</b></td>
                   <td>: Rp. {{ number_format($total_penyewaan_barangjasa) }}</td>
                </tr>
                <tr>
                   <td colspan="6"><b>Total Pembelian</b></td>
                   <td>: Rp. {{ number_format($total_pembelian_barangjasa) }}</td>
                </tr>
                <tr>
                   <td colspan="6"><b>Total Pemasukan</b></td>
                   <td>: Rp. {{ number_format($total_pemasukan_barangjasa) }}</td>
                </tr>

            </tbody>
        </table>

        <br/>
        <h4>Total Subsidi Mitra</h4>
        <table class="table">
            <thead>
                <tr class="font-weight-bold" style="text-align:center">
                    <td><b>No</b></td>
                    <td><b>Nama</b></td>
                    <td><b>Mitra</b></td>
                    <td><b>Jumlah</b></td>
                    <td><b>Tanggal</b></td>
                    <td><b>Nilai</b></td>
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
                   <td colspan="5"><b>Total Subsidi Mitra</b></td>
                   <td>: Rp. {{ number_format($total_pemasukan_bagihasil) }}</td>
                </tr>


            </tbody>
        </table>

        <br/>
        <h4>Sumber Daya Barang</h4>
        <table class="table">
            <thead>
                <tr class="font-weight-bold" style="text-align:center">
                    <td><b>No</td>
                    <td><b>Nama Barang</b></td>
                    <td><b>Nomor Barang</b></td>
                    <td><b>Keterangan</b></td>
                    <td><b>Tanggal Pembelian</b></td>
                    <td><b>Harga Barang</b></td>
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
                   <td colspan="5"><b>Total Nilai Barang</b></td>
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
                <tr class="font-weight-bold" style="text-align:center">
                    <td><b>No</b></td>
                    <td><b>Keterangan Pengeluaran</b></td>
                    <td><b>Nilai</b></td>
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
                   <td colspan="2"><b>Total Pemasukan</b></td>
                   <td>: Rp. {{ number_format($pemasukan_all) }}</td>
               </tr>
                <tr>
                   <td colspan="2"><b>Total Pengeluaran</b></td>
                   <td>: Rp. {{ number_format($pengeluaran_all) }}</td>
                </tr>
                <tr>
                   <td colspan="2"><b>Total Laba</b></td>
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

        <br/>
        <h4>Pembagian Hasil Usaha</h4>
        <table class="table">

                <tr>
                   <td colspan="2"><b>Modal Usaha 25%</b></td>
                   <td>: Rp. {{ number_format($total_saldo*25/100)}}</td>
               </tr>
                <tr>
                   <td colspan="2"><b>Untuk Desa 40%</b></td>
                   <td>: Rp. {{ number_format($total_saldo*40/100)}}</td>
                </tr>
                <tr>
                   <td colspan="2"><b>Kapasitas 10%</b></td>
                   <td>: Rp. {{ number_format($total_saldo*10/100)}}</td>
                </tr>
                <tr>
                    <td colspan="2"><b>Gaji Pegawai 25%</b></td>
                    <td>: Rp. {{ number_format($total_saldo*25/100)}}</td>
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
