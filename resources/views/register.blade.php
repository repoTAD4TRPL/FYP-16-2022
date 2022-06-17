<html>
    <head>
     <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('assets/css/style-sign.css') }}" rel="stylesheet">

    </head>
    <body>
    
    <!------ Include the above in your HEAD tag ---------->

    <div class="wrapper ">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="{{ URL::asset('assets/images/logo.png') }}" id="icon" alt="User Icon" />
            </div>
            <center>
                <h5>Bumdesta</h5>
                <br/>
                <b>Register Account</b>
            </center>
            <!-- Login Form -->
            <br/>
            <br/>
            <form>
                <div class="container">
                    <div class="form-group">
                        <input type="text"  class="form-control form-lg" name="login" placeholder="NIP">
                    </div>
                    <div class="form-group mb-4">
                        <input type="password"  class="form-control form-lg" name="login" placeholder="PASSWORD">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="" class="text-primary float-left">Sign in</a>
                        </div>
                        <div class="col-lg-6">
                            <input type="submit" class=" float-right btn btn-primary" value="Log In">
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