<div id="RawItemStock_updated_status"></div>
<div class="row form-horizontal">
    <input type="hidden" name="RawItemStock_Id" id="RawItemStock_Id">
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">ItemName</label>
            <div class="col-sm-8">
                <select style="width:100%" id="ItemName_Stock" class="form-control input-sm select2">
                    <option value="" selected disabled>ItemName...</option>
                    @foreach($RawItem as $obj)
                    <option value="{{$obj->ItemId}}">{{$obj->ItemName}}</option>
                    @endforeach
                </select>

            </div>
        </div>


        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Purchase Rate</label>
            <div class="col-sm-8">
                <input id="PRate" class="form-control input-sm" placeholder="Purchase Rate">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-4 control-label">VAT</label>
            <div class="col-sm-8">
                <input id="VAT" class="form-control input-sm" placeholder="VAT">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Sale Rate</label>
            <div class="col-sm-8">
                <input id="SRate" class="form-control input-sm" placeholder="Sale Rate">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Qty</label>
            <div class="col-sm-8">
                <input id="Qty" class="form-control input-sm" placeholder="Qty">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Store Name</label>
            <div class="col-sm-8">
                <select style="width:100%" id="Store" class="form-control input-sm select2">
                    <option value="" selected disabled>Store Name...</option>
                    @foreach($Store as $obj)
                    <option value="{{$obj->StoreId}}">{{$obj->StoreName}}</option>
                    @endforeach
                </select>

            </div>
        </div>


    </div>

</div>





<div class="box-header ">
    <div class="pull-right">
        <button onclick="insertRawItemStock()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>

        <button onclick="ShowRawItemStocks()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button onclick="UpdateRawItemStock()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>


    </div>
</div>


<div class="modal fade" id="RawItemStockModal" tabindex="-1" RawItemStock="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" style="width: 80%;" RawItemStock="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <b>Edit RawItemStock </b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
            </div>
            <div class="modal-body">

                <div id="RawItemStock_deleted_status"></div>
                <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf -->

                <div class="box-body">
                    <div id="here_show_table_content_RawItemStock">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">RawItemStock</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="AllRawItemStocks">

                            </tbody>
                        </table>
                    </div>

                    <div class="box-footer">
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>