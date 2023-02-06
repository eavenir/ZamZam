<div id="SubMenu_updated_status"></div>
<div class="row form-horizontal">
    <input type="hidden" name="SubMenu_Id" id="SubMenu_Id">
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">SubMenu</label>
            <div class="col-sm-8">
                <input id="SubMenu" required type="text" class="form-control input-sm" placeholder="SubMenu">
                <label id="SubMenuError"></label>

            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Menu</label>
            <div class="col-sm-8">
                <select style="width:100%" id="Menu_SubMenu" class="form-control input-sm select2">
                    <option value="" selected disabled>Menu...</option>
                    @foreach($Menu as $obj)
                    <option value="{{$obj->id}}">{{$obj->Menu}}</option>
                    @endforeach
                </select>
                <label id="MenuError"></label>

            </div>
        </div>

    </div>

</div>





<div class="box-header ">
    <div class="pull-right">
        <button id="InsertSubMenuBtn" onclick="insertSubMenu()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>

        <button onclick="ShowSubMenu()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button id="UpdateSubMenuBtn" onclick="UpdateSubMenu()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>


    </div>
</div>


<div class="modal fade" id="SubMenuModal" tabindex="-1" SubMenu="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" style="width: 80%;" SubMenu="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <b> Edit Sub Menu</b>


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
            </div>
            <div class="modal-body">

                <div id="SubMenu_deleted_status"></div>
                <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf -->

                <div class="box-body">
                    <div id="here_show_table_content_SubMenu">

                    </div>

                    <div class="box-footer">
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>