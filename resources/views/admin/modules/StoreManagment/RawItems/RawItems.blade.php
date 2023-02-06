@extends('admin/layouts/mainlayout')
@section('content')


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
                                        <li class="active"><a href="#tab_1" data-toggle="tab">Raw Items</a></li>
                                        <li><a href="#tab_2" data-toggle="tab">Raw Items Stock</a></li>
                                        <li><a href="#tab_3" data-toggle="tab">Unit</a></li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            @include('admin/modules/StoreManagment/RawItems/RawItems_html')
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            @include('admin/modules/StoreManagment/RawItems/RawItemsStock')

                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_3">
                                            @include('admin/modules/StoreManagment/RawItems/Unit')

                                        </div>

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

@include('admin/modules/StoreManagment/RawItems/RawItemsjs')
@include('admin/modules/StoreManagment/RawItems/RawItemsStockjs')
@include('admin/modules/StoreManagment/RawItems/Unitjs')


@endsection