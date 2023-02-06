<div id="Menu_updated_status"></div>
<div class="row form-horizontal">
    <input type="hidden" name="Menu_Id" id="Menu_Id">
    <div class="col-md-6">
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Menu</label>
            <div class="col-sm-8">
                <input id="Menu" required type="text" class="form-control input-sm" placeholder="Menu">
                <label id="MenuError"></label>

            </div>
        </div>

    </div>

</div>





<div class="box-header ">
    <div class="pull-right">
        <button onclick="insertMenu()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>

        <button onclick="ShowMenus()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button onclick="UpdateMenu()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>


    </div>
</div>


<div class="modal fade" id="AllMenusModal" tabindex="-1" Menu="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" style="width: 80%;" Menu="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <b>Edit Menu </b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
            </div>
            <div class="modal-body">

                <div id="Menu_deleted_status"></div>
                <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf -->

                <div class="box-body">
                    <div id="here_show_table_content_Menu">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="AllMenus">

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