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

                <div class="box box-default">

                    <div class=" box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Custom Tabs -->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1" data-toggle="tab">Menu</a></li>
                                        <li><a href="#tab_2" data-toggle="tab">Sub Menu</a></li>
                                        <li><a href="#tab_3" data-toggle="tab">Dish</a></li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            @include('admin/modules/StoreManagment/DishMenu/Menu')
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            @include('admin/modules/StoreManagment/DishMenu/SubMenu')

                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_3">
                                            @include('admin/modules/StoreManagment/DishMenu/Dish_html')

                                        </div>

                                        <div class="tab-pane" id="tab_4">



                                        </div>
                                        <div class="tab-pane" id="tab_5">


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

@include('admin/modules/StoreManagment/DishMenu/Menujs')
@include('admin/modules/StoreManagment/DishMenu/SubMenujs')
@include('admin/modules/StoreManagment/DishMenu/Dishjs')


@endsection