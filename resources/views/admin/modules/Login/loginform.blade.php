@extends('admin/layouts/loginformlayout')
@section('content')
<div class="row">

    <div style="display: flex;justify-content: center;align-items: center;height: 100vh;background-color: darkcyan;color:white"
        class="col-md-4">

        <div style="text-align:center;">

            <h2 style="font-weight:bold">
                Welcome Back!
            </h2>

            <img src="/Images/Plant.png" style="width:200px;" alt="">

        </div>

    </div>

    <div style="display: flex;justify-content: center;align-items: center;height: 100vh;" class="col-md-8">

        <div style="">
            <div class="login-box">

                <!-- /.login-logo -->
                <div class="login-box-body">

                    <div class="form-group has-feedback" style="display:flex;justify-content:center">
                        <h1 style="font-weight:bold;color:darkcyan">
                            Login
                        </h1>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="email" id="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" id="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row" style="display:flex;justify-content:center">

                        <!-- /.col -->
                        <div class="col-xs-6">
                            <button onclick="Login()" style="background-color:darkcyan;color:white"
                                class="btn btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <p id="not_loggen_in"></p>

                        </div>

                    </div>


                </div>
                <!-- /.login-box-body -->
            </div>

        </div>

    </div>

</div>
<!-- /.login-box -->
<script>
function Login() {
    var Email = document.getElementById('email').value;
    var Password = document.getElementById('password').value;
    var token = "{{csrf_token()}}";
    $.ajax({
        url: '/login_user',
        type: 'post',
        data: {
            email: Email,
            password: Password,
            _token: token
        },
        success: function(data) {
            // console.log(data)
            if (data.status == 'exist') {
                sessionStorage.setItem("sessionToken", data.sessionToken);
                sessionStorage.setItem('LoggedIn_User', JSON.stringify(data.User));
               
                sessionStorage.setItem('Permissions_of_selected_role', JSON.stringify(data.Permissions_of_selected_role));
              
                $.ajax({
                    url: 'setsessionToken',
                    type: 'get',
                    data: {
                        token: data.sessionToken,
                    },
                    success: function(data) {
                        // console.log(data);
                        if (data) {
                            window.open('/home', '_self')
                        }
                    }
                })
            } else {
                document.getElementById('not_loggen_in').innerHTML =
                    "You are not authorized, Please try again.";
            }
        }
    });
}
</script>
@endsection