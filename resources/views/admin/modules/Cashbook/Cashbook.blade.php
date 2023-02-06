@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">

        <div class="container-fluid">

            <div class="box box-default">

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">CashBook</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        @include('admin/modules/Cashbook/Cashbook_html')

                                    </div>
                                   
                                </div>
                                <!-- /.tab-content -->
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

</div>
</section>

@include('admin/modules/Cashbook/Cashbookjs')

@endsection