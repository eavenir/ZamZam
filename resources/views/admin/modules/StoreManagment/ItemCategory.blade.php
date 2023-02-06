@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Item Category</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="box box-default">

                    <div class="box-body">

                        <div class="row">
                            <div id="ItemCategory_insert_status"></div>
                            <div class="row form-horizontal">
                                <input type="hidden" name="ItemCategory_id" id="ItemCategory_id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Item Category</label>
                                        <div class="col-md-8">
                                            <input id="ItemCategory" required type="text" name="ItemCategory" class="form-control input-sm" placeholder="Item Category">
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="box-header ">
                                <div class="pull-right">
                                    <button id="InsertItemCategoryBtn" onclick="insertItemCategory()" class="btn btn-default">
                                        <i class="fa fa-fw fa-save"></i> Save
                                    </button>

                                    <button onclick="ShowItemCategory()" class="btn btn-default">
                                        <i class="fa fa-fw fa-eye"></i> Show
                                    </button>
                                    <button id="UpdateItemCategoryBtn" onclick="UpdateItemCategory()" class="btn btn-default">
                                        <i class="fa fa-fw fa-refresh"></i> Update
                                    </button>
                                </div>
                            </div>


                            <div class="modal fade" id="ItemCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <b> Edit ItemCategory </b>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>

                                        </div>
                                        <div class="modal-body">

                                            <div class="box-body">
                                                <div id="ItemCategory_delete_status"></div>
                                                <div id="here_show_table_content_ItemCategory">
                                                    <table id="table_ItemCategory" class="table">
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

@include('admin/modules/StoreManagment/ItemCategoryjs')
@endsection