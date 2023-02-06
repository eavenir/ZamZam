@extends('admin/layouts/mainlayout')
@section('content')

<style>
    .container {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        width: 100%;
    }

    input[type="file"] {
        position: absolute;
        z-index: -1;
        top: 10px;
        left: 8px;
        font-size: 17px;
        color: #b8b8b8;
    }

    .button-wrap {
        position: relative;
    }

    .button {
        display: inline-block;
        padding: 5px 27px;
        cursor: pointer;
        border-radius: 5px;
        background-color: #8ebf42;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
    }
</style>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div id="roles" class="row">

                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="box box-default">

                    <div class=" box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1" data-toggle="tab">User</a></li>
                                        <li><a href="#tab_5" data-toggle="tab">Assign Heads</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            @include('admin/modules/UserBook/User_html')

                                        </div>
                                      

                                        <div class="tab-pane" id="tab_5">

                                            @include('admin/modules/BasicMenu/AssignHead')

                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </section>
</div>


@include('admin/modules/UserBook/Userjs')
@include('admin/modules/BasicMenu/AssignHeadjs')


@endsection