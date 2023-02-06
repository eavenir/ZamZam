<div id="RawItem_updated_status"></div>
<div class="row form-horizontal">
    <input type="hidden" name="RawItem_Id" id="RawItem_Id">
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">ItemName</label>
            <div class="col-sm-8">
                <input id="ItemName" required type="text" class="form-control input-sm" placeholder="ItemName">

            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">اسم العنصر</label>
            <div class="col-sm-8">
                <input id="ItemName_Arabic" required type="text" class="form-control input-sm" placeholder="اسم العنصر">

            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Item Sub Category</label>
            <div class="col-sm-8">
                <select id="ItemSubCategory" class="form-control input-sm select2">
                    <option value="" selected disabled>Item Sub Category...</option>
                    @foreach($ItemSubCategory as $obj)
                    <option value="{{$obj->SubCategoryId}}">{{$obj->SubCategory}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Unit</label>
            <div class="col-sm-8">
                <select id="Unit" class="form-control input-sm select2">
                    <option value="" selected disabled>Unit...</option>
                    @foreach($Unit as $obj)
                    <option value="{{$obj->id}}">{{$obj->Unit}}</option>
                    @endforeach
                </select>

            </div>
        </div>


    </div>

</div>





<div class="box-header ">
    <div class="pull-right">
        <button onclick="insertRawItem()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>

        <button onclick="ShowRawItem()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button onclick="UpdateRawItem()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>


    </div>
</div>


<div class="modal fade" id="RawItemModal" tabindex="-1" RawItem="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" style="width: 80%;" RawItem="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <b>Edit RawItem </b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
            </div>
            <div class="modal-body">

                <div id="RawItem_deleted_status"></div>
                <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf -->

                <div class="box-body">
                    <div id="here_show_table_content_RawItem">

                    </div>

                    <div class="box-footer">
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>