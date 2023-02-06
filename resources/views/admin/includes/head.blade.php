<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title>AdminLTE 3 | Dashboard</title> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{asset('images/genny.png')}}">
    <link rel="stylesheet" href="{{ asset('adminassets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminassets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('adminassets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminassets/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminassets/dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('adminassets/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('adminassets/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('adminassets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminassets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('adminassets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminassets/bower_components/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminassets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <style>
        .loader {
            position: fixed;
            left: 50%;
            top: 30%;
            width: 10%;
            height: 10%;
            z-index: 9999;
            background: url(/images/loader.svg) 50% 50% no-repeat;
        }

        .abc-content {
            display: none;
        }

        .abc:hover .abc-content {
            display: block;
        }

        @media(max-width:430px) {
            #ShowHeadsModalId {
                width: 95%
            }
        }

        @media(min-width:750px) {
            #ShowHeadsModalId {
                width: 25%
            }
        }
    </style>
    <div class="loader"></div>
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a style="background-color:#222d32;" href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->

                <!-- logo for regular state and mobile devices -->

                <span class="logo-lg"><b style="float: left;">{{Session::get('AH')}}</b></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav style="background-color: #222d32;" class="navbar navbar-static-top">

                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>


                <div class="navbar-custom-menu">

                    <ul style="display: flex; align-items:center;" class="nav navbar-nav">

                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else

                        <p style="display:none" id="AccountHeadValue">{{Session::get('AH')}}</p>

                        <li class="nav-item ">
                            <span style="color: white;" class="nav-link ">
                                <p style="margin-top:10px" id="AccountHeadCompanyName">{{Session::get('CompanyName')}}
                                </p>
                            </span>

                        </li>




                        @endguest
                        <li class="nav-item ">
                            <span style="color: white;" class="nav-link ">
                                <p style="margin-top:10px" id="Selected_Head">

                                    <script>
                                        document.write(sessionStorage.getItem('Selected_Head') == null ? '' : sessionStorage
                                            .getItem('Selected_Head'))
                                    </script>

                                </p>
                            </span>

                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#" onclick="getHeads()" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-caret-down"></i>
                            </a>

                        </li>


                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img id="LoggedIn_User_Img" src="/" class="user-image">
                                <span id="LoggedIn_UserName" class="hidden-xs">
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="/" class="img-circle" alt="User Image">

                                    <p>

                                        <small></small>
                                        <small></small>
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="/Profile" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <p onclick="Logout()" class="btn btn-default btn-flat">Logout</p>


                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->

                    </ul>
                </div>

            </nav>
        </header>

        <div class="modal fade" id="ShowHeadsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog mw-100" id="ShowHeadsModalId" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <b> Select Head </b>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h5>

                    </div>
                    <div class="modal-body">
                        <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                    @csrf -->
                        <div class="box-body">
                            <div id="where_heads_show" style="display:block;text-align:center">



                            </div>

                        </div>
                        <div class="box-footer">
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script>
            $(".loader").hide();

            

            function Logout() {
                console.log('logout called')
                var token = sessionStorage.getItem('sessionToken');
                sessionStorage.removeItem('sessionToken');
                sessionStorage.removeItem('Selected_Head');
                sessionStorage.removeItem('LoggedIn_User')
                $.ajax({
                    url: 'logout',
                    type: 'get',
                    data: {
                        token: token,
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status) {

                            window.open('/home', '_self')
                        }
                    }
                })
            }

            // console.log(JSON.parse(sessionStorage.getItem('LoggedIn_User')))
            if (document.getElementById('Selected_Head').innerText == '') {
                getHeads()
            }

            function getHeads() {
                $.ajax({
                    url: '/getHeads',
                    type: 'get',
                    data: {
                        LoggedIn_UserName: JSON.parse(sessionStorage.getItem('LoggedIn_User'))
                    },
                    beforeSend: function() {
                        $(".loader").show();
                    },
                    success: function(data) {
                        console.log(data)
                        // console.log("company data is :"+data)
                        if (data != '') {
                            $('.loader').hide()
                            var Heads = '';
                            data.forEach(el => {
                                // console.log(sessionStorage.getItem('Selected_Head'))
                                Heads += `
                            
          <p style="cursor:pointer" onclick="setSessionHead('${el.AccountHead}')">
          <i class="${sessionStorage.getItem('Selected_Head') == el.AccountHead ? 'fa fa-check' : '' }"> </i>
          ${el.AccountHead}
          </p>
          `;
                                document.getElementById('where_heads_show').innerHTML = Heads;
                            });
                            // console.log(data[0].AccountHead)
                            if (document.getElementById('Selected_Head').innerText != '') {
                                $('#ShowHeadsModal').modal('show')
                            } else {

                                setSessionHead(data[0].AccountHead)
                            }
                        } else {
                            $('.loader').show()
                        }

                    },
                    error: function(req, status, error) {
                        console.log(error)

                    }
                })
            }

            function setSessionHead(value) {
                // alert(value)
                sessionStorage.setItem('Selected_Head', value)
                document.getElementById('Selected_Head').innerText = value;


                $('#ShowHeadsModal').modal('hide')

            }

            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()
            })
        </script>