<div id="Dish_updated_status"></div>
<div class="row form-horizontal">
    <input type="hidden" name="Dish_Id" id="Dish_Id">
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Dish</label>
            <div class="col-sm-8">
                <input id="DishName" required type="text" class="form-control input-sm" placeholder="Dish">

            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Dish Arabic</label>
            <div class="col-sm-8">
                <input id="DishName_Arabic" required type="text" class="form-control input-sm" placeholder="Dish Arabic">

            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Sub Menu</label>
            <div class="col-sm-8">
                <select style="width:100%" id="SubMenu_Dish" class="form-control input-sm select2">
                    <option value="" selected disabled>Sub Menu...</option>
                    @foreach($SubMenu as $obj)
                    <option value="{{$obj->Id}}">{{$obj->SubMenu}}</option>
                    @endforeach
                </select>

            </div>
        </div>

    </div>

</div>





<div class="box-header ">
    <div class="pull-right">
        <button onclick="insertDish()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>

        <button onclick="ShowDish()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button onclick="UpdateDish()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>


    </div>
</div>


<div class="modal fade" id="DishModal" tabindex="-1" Dish="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" style="width: 80%;" Dish="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <b>Edit Dish </b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
            </div>
            <div class="modal-body">

                <div id="Dish_deleted_status"></div>
                <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf -->

                <div class="box-body">
                    <div id="here_show_table_content_Dish">
                        
                    </div>

                    <div class="box-footer">
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>