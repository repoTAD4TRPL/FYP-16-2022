<html>
    <head>
     <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/style-sign.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="<?php echo asset('assets/images/logo.png'); ?>">

    </head>
    <body>
    
    <!------ Include the above in your HEAD tag ---------->

    <div class="wrapper ">
        <div id="formContent">
            <!-- Tabs Titles -->
            <?php  $website_component    = DB::table('website')->where(['id' => 1])->first(); ?>
            <br/>
            <!-- Icon -->
            <div class="fadeIn first">
                <img src="{{ $website_component !='' ?  URL::asset('assets/images/'.$website_component->logo) :  URL::asset('assets/images/logo.png'); }}" id="" alt="User Icon" width ="150px"; height= "150px"; />
            </div>
            
           
            <center>
                <h5>{{ $website_component !='' ? $website_component->name : 'Default'; }}</h5>
                
                <b>Silahkan Masuk</b>
            </center>
            <!-- Login Form -->
            <br/>
            <br/>
            <form action="{{ url('authentication/sign') }}" method="post">
                @csrf
                <div class="container">
                    <div class="form-group">
                        <input type="text"  class="form-control form-lg" name="nip" placeholder="Username" required>
                    </div>
                    <div class="form-group mb-4">
                        <input type="password"  class="form-control form-lg" name="password" placeholder="Password" required>
                    </div>
                    @if(Session::has('failed'))
                    <div class="alert alert-danger mt-4" role="alert">
                        {{  Session::get('failed') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- <a href="" class="text-primary float-left">Register</a> -->
                        </div>
                        <div class="col-lg-6">
                            <input type="submit" class="float-right btn btn-primary" value="Login">
                        </div>
                    </div>

                   
                   
                </div>
            </form>

         
        </div>
    </div>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    </body>
</html>