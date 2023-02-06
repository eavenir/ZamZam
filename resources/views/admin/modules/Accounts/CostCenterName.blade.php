@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Cost Center</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="box box-default">

                    <div class="box-body">

                        <div class="row">
                            <div id="cost_center_name_insert_status"></div>
                            <div class="row form-horizontal">
                                <input type="hidden" name="CostCenterName_id" id="CostCenterName_id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Cost Center Name</label>
                                        <div class="col-md-8">
                                            <input id="CostCenterName" required type="text" name="CostCenterName" class="form-control input-sm" placeholder="Cost Center Name">
                                            <label id="CostCenterNameError"></label>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="box-header ">
                                <div class="pull-right">
                                    <button id="InsertCostCenterBtn" onclick="insertCostCenterName()" class="btn btn-default">
                                        <i class="fa fa-fw fa-save"></i> Save
                                    </button>

                                    <button onclick="showUpdated_CostCenterName()" class="btn btn-default">
                                        <i class="fa fa-fw fa-eye"></i> Show
                                    </button>
                                    <button id="UpdateCostCenterBtn" onclick="updateCostCenterName()" class="btn btn-default">
                                        <i class="fa fa-fw fa-refresh"></i> Update
                                    </button>
                                </div>
                            </div>


                            <div class="modal fade" id="CostCenterNameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <b> Edit Cost Center Name </b>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>

                                        </div>
                                        <div class="modal-body">

                                            <div class="box-body">
                                                <div id="cost_center_name_delet_status"></div>
                                                <div id="here_show_table_content_CS">
                                                    <table id="table_cost_center_name" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Cost Center Name</th>
                                                                <th scope="col">Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="box-footer">
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </section>

</div>

@include('admin/modules/Accounts/CostCenterNamejs')
@endsection