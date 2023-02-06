@extends('admin/layouts/mainlayout')
@section('content')

<style>
    #Document_Images {
        position: absolute;
        z-index: -1;
        top: 10px;
        left: 8px;
        font-size: 17px;
        color: #b8b8b8;
    }



    .button {
        display: inline-block;
        padding: 3px 15px;
        cursor: pointer;
        border-radius: 5px;
        background-color: #8ebf42;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        width: 100%;
        text-align: center;
    }
</style>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">



            <div class="row">

                <div class="box box-default">

                    <div class="box-body">
                        <!-- <form onsubmit="event.preventDefault(); check()" id="formId" method="post" action="insertArea">
                            @csrf -->
                        <div id="show_insert_status">

                        </div>

                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">

                                    <li class="active" id="Employee_Tab"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Employee</a></li>
                                    <li id="Employee_Category_Tab" class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Category</a></li>
                                    <!-- <li id="Employee_Attendance_Tab" class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true">Attendance</a></li> -->

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        @include('admin/modules/Employee/Employee_html')


                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        @include('admin/modules/Employee/EmployeeCategory')


                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane " id="tab_3">


                                    </div>
                                   
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- nav-tabs-custom -->
                        </div>

                        <!-- Employees modal code starts from here -->

                    </div>

                </div>
            </div>

        </div>

    </section>

</div>


@include('admin/modules/Employee/Employeejs')
@include('admin/modules/Employee/EmployeeCategoryjs')
@include('admin/modules/Employee/Attendancejs')

@endsection