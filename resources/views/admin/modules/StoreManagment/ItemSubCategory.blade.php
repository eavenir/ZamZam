@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Sub Category</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="box box-default">

                    <div class="box-body">

                        <div class="row">
                            <div id="ItemSubCategory_insert_status"></div>
                            <div class="row form-horizontal">
                                <input type="hidden" name="ItemSubCategory_id" id="ItemSubCategory_id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Sub Category</label>
                                        <div class="col-md-8">
                                            <input id="ItemSubCategory" required type="text" name="ItemSubCategory" class="form-control input-sm" placeholder="Sub Category">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Item Category</label>
                                        <div class="col-md-8">
                                            <select id="ItemCategory" class="form-control input-sm select2">
                                                <option value="" selected disabled>Item Category...</option>
                                                @foreach($ItemCategory as $obj)
                                                <option value="{{$obj->ItemCategoryId}}">{{$obj->ItemCategory}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="box-header ">
                                <div class="pull-right">
                                    <button id="InsertItemSubCategoryBtn" onclick="insertItemSubCategory()" class="btn btn-default">
                                        <i class="fa fa-fw fa-save"></i> Save
                                    </button>

                                    <button onclick="ShowItemSubCategory()" class="btn btn-default">
                                        <i class="fa fa-fw fa-eye"></i> Show
                                    </button>
                                    <button id="UpdateItemSubCategoryBtn" onclick="UpdateItemSubCategory()" class="btn btn-default">
                                        <i class="fa fa-fw fa-refresh"></i> Update
                                    </button>
                                </div>
                            </div>


                            <div class="modal fade" id="ItemSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <b> Edit Item Sub Category </b>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>

                                        </div>
                                        <div class="modal-body">

                                            <div class="box-body">
                                                <div id="ItemSubCategory_delete_status"></div>
                                                <div id="here_show_table_content_ItemSubCategory">
                                                    <table id="table_ItemSubCategory" class="table">
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

@include('admin/modules/StoreManagment/ItemSubCategoryjs')
@endsection