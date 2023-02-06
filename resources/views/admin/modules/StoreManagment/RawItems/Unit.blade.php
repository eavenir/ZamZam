<div id="Unit_updated_status"></div>
<div class="row form-horizontal">
    <input type="hidden" name="Unit_Id" id="Unit_Id">
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Unit</label>
            <div class="col-sm-8">
                <input id="Unit_Unit" required type="text" class="form-control input-sm" placeholder="Unit">
                <label id="UnitError"></label>

            </div>
        </div>

    </div>

</div>





<div class="box-header ">
    <div class="pull-right">
        <button onclick="insertUnit()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>

        <button onclick="ShowUnits()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button onclick="UpdateUnit()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>


    </div>
</div>


<div class="modal fade" id="AllUnitsModal" tabindex="-1" Unit="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" style="width: 80%;" Unit="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <b>Edit Unit </b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
            </div>
            <div class="modal-body">

                <div id="Unit_deleted_status"></div>
                <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf -->

                <div class="box-body">
                    <div id="here_show_table_content_Unit">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="AllUnits">

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