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
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Expense</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Expense Type</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        @include('admin/modules/Expense/Expense_html')

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                    @include('admin/modules/Expense/ExpenseType_html')

                                    </div>


                                    <!-- /.tab-pane -->
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

@include('admin/modules/Expense/Expensejs')
@include('admin/modules/Expense/ExpenseTypejs')

@endsection