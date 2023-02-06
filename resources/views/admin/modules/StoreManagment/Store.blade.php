@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Store</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="box box-default">

                    <div class="box-body">

                        <div class="row">
                            <div id="store_insert_status"></div>
                            <div class="row form-horizontal">
                                <input type="hidden" name="store_id" id="store_id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Store Name</label>
                                        <div class="col-md-8">
                                            <input id="StoreName" required type="text" name="StoreName" class="form-control input-sm" placeholder="Store Name">
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="box-header ">
                                <div class="pull-right">
                                    <button id="InsertStoreBtn" onclick="insertStore()" class="btn btn-default">
                                        <i class="fa fa-fw fa-save"></i> Save
                                    </button>

                                    <button onclick="ShowStores()" class="btn btn-default">
                                        <i class="fa fa-fw fa-eye"></i> Show
                                    </button>
                                    <button id="UpdateStoreBtn" onclick="UpdateStore()" class="btn btn-default">
                                        <i class="fa fa-fw fa-refresh"></i> Update
                                    </button>
                                </div>
                            </div>


                            <div class="modal fade" id="StoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <b> Edit Store </b>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>

                                        </div>
                                        <div class="modal-body">

                                            <div class="box-body">
                                                <div id="store_delete_status"></div>
                                                <div id="here_show_table_content_Store">
                                                    <table id="table_Store" class="table">
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

@include('admin/modules/StoreManagment/Storejs')
@endsection