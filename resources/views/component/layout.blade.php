<html>
    <head>
        <meta charset="utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/datatables.min.css') }}" rel="stylesheet">
		<link href="{{ URL::asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php echo asset('assets/images/logo.png'); ?>">

        <title>BUMDESTA</title>
    </head>
    <body>
    <?php
        $sign_check = DB::table('administrator')->where(['status' => 1, 'id' => Session::get('id')])->first();
        $jabatan    = DB::table('jabatan')->where(['status' => 1, 'id_jabatan' => $sign_check->id_jabatan])->first();
        $website_component    = DB::table('website')->where(['id' => 1])->first(); 
    ?>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light  navbar_custom" >
        <div class="container-fluid" style="padding-left:60px;padding-right:60px;">
            <a class="navbar-brand" href="#">
                <img class="mr-2" src="{{ $website_component !='' ?  URL::asset('assets/images/'.$website_component->logo) :  URL::asset('assets/images/logo.png'); }}" width="75" height="75" alt="">
                <span class="ml-2 text-white font-weight-bold" style="font-size:22px;">{{ $website_component !='' ? $website_component->name : 'Default'; }}</span>
            </a>
            <div class="navbar-nav">
                <center>
                    <span class="text-white font-weight-bold">{{ $jabatan->nama_jabatan; }}</span>
                    <img class="mr-2 ml-2 img-responsive rounded-circle" src="{{ $sign_check->avatar !='' ? URL::to('assets/images/pegawai/'.$sign_check->avatar) : URL::asset('assets/images/default.jpeg') }}" width="40" height="40"  alt="">
                    <div class="btn-group text-white" style="color:#ffffff !important;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-white font-weight-bold">{{ $sign_check->nama }}</span></a>

                        <div class="dropdown-menu text-dark">
                            <a class="dropdown-item text-dark" href="{{ url('administrator/profile') }}">Profile</a>
                            <a class="dropdown-item text-dark" href="{{ url('administrator/pegawai') }}">Daftar Pegawai</a>
                            @if(Session::get('jabatan') == '1')
                            <a class="dropdown-item text-dark" href="{{ url('administrator/pengaturan') }}">Pengaturan</a>
                            @endif
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('signout') }}">Keluar</a>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-dark bg-white text-dark" >
        <div class="container">
           
            <div class="navbar-collapse collapse text-dark" id="navbar10">
                <ul class="navbar-nav nav-fill w-100">
                    <li class="nav-item {{ $master == 'dashboard' ? 'active_navtrue' : '' }}">
                        <a class="nav-link text-dark font-weight-bold" href="{{ url('administrator/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item {{ $master == 'unit_usaha' ? 'active_navtrue' : '' }}">
                        <a class="nav-link text-dark font-weight-bold" href="{{ url('administrator/unit-usaha') }}">Unit Usaha</a>
                    </li>
                    <li class="nav-item {{ $master == 'logistik' ? 'active_navtrue' : '' }}">
                        <a class="nav-link text-dark font-weight-bold" href="{{ url('administrator/logistik') }}">Logistik</a>
                    </li>
                    <li class="nav-item {{ $master == 'barang_jasa' ? 'active_navtrue' : '' }}">
                        <a class="nav-link text-dark font-weight-bold" href="{{ url('administrator/barang-jasa') }}">Transaksi</a>
                    </li>
               
                    <li class="nav-item dropdown {{ $master == 'bagi_hasil_usaha' ? 'active_navtrue' : '' }}">
                        <a class="nav-link dropdown-toggle text-dark font-weight-bold" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Subsidi Mitra</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{ $page == 'bagi_hasil_usaha' ? 'active_navtrue' : '' }}" href="{{ url('administrator/bagi-hasil-usaha') }}">Informasi Subsidi</a>
                            <a class="dropdown-item {{ $page == 'bagi_hasil_usaha_mitra' ? 'active_navtrue' : '' }}" href="{{ url('administrator/mitra') }}">Mitra</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown {{ $master == 'asset_keuangan' ? 'active_navtrue' : '' }}">
                        <a class="nav-link dropdown-toggle text-dark font-weight-bold" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Sumber Daya & Keuangan</a>
                        <div class="dropdown-menu">
                            <a class="dropdown dropdown-item " data-toggle="dropdown" aria-haspopup="true">Sumber Daya <img src="{{ URL::asset('assets/images/down.png') }}" width="10%" height="10%" alt=""></a>
                            <ul class="dropdown-submenu" hidden="hidden" id="list">
                                <a class="dropdown-item {{ $page == 'asset' ? 'active_navtrue' : '' }}" href="{{ url('administrator/asset') }}">Barang</a>
                                <a class="dropdown-item {{ $page == 'manusia' ? 'active_navtrue' : '' }}" href="{{ url('administrator/manusia') }}">Manusia</a>
                            </ul>
                            <a class="dropdown-item {{ $page == 'keuangan' ? 'active_navtrue' : '' }}" href="{{ url('administrator/keuangan') }}">Keuangan</a>
                            <a class="dropdown-item {{ $page == 'asset_keuangan_grafik' ? 'active_navtrue' : '' }}" href="{{ url('administrator/asset-keuangan-grafik/'.date('Y')) }}">Grafik</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown {{ $master == 'laporan' ? 'active_navtrue' : '' }}">
                        <a class="nav-link dropdown-toggle text-dark font-weight-bold" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Laporan</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{ $page == 'laporan_keuangan' ? 'active_navtrue' : '' }}" href="{{ url('administrator/laporan-keuangan') }}">Keuangan</a>
                            <a class="dropdown-item {{ $page == 'laporan_kegiatan' ? 'active_navtrue' : '' }}" href="{{ url('administrator/laporan-kegiatan') }}">Kegiatan</a>
                            <a class="dropdown-item {{ $page == 'artefak' ? 'active_navtrue' : '' }}" href="{{ url('administrator/artefak') }}">Artefak</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    
    <footer class="">
        <p class="copyright pt-3">COPYRIGHT Bumdesta 2022</p>
    </footer>
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            let element = document.getElementById("list");
        $('.dropdown-menu a.dropdown').on("click", function(e){
            element.removeAttribute("hidden");
            $(this).next('ul').toggle();
            e.preventDefault();
            e.stopPropagation();
        });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#default-tb').DataTable();
        });

        function rupiahformat(angka){
            var reverse = angka.toString().split('').reverse().join(''),
            ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join(',').split('').reverse().join('');
            return ribuan;
        }

        var tanpa_rupiah = document.getElementById('formatrupiah');
            tanpa_rupiah.addEventListener('keyup', function(e){
            tanpa_rupiah.value = formatRupiah(this.value);
        });

        var tanpa_rupiah2 = document.getElementById('formatrupiah2');
            tanpa_rupiah2.addEventListener('keyup', function(e){
            tanpa_rupiah2.value = formatRupiah(this.value);
        });

        /* Fungsi */
        function formatRupiah(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function formatrupiah2(angka, prefix)
        {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

            
    </script>


    @yield('javascript')
    </body>
</html>