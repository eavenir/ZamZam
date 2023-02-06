<div class="row form-horizontal">
    <input type="hidden" id="token" value="{{csrf_token()}}">
    <div class="col-md-8">
        <div class="form-group">
            <label for="" class="control-label col-md-4">Category</label>
            <div class="col-md-8">
                <input id="EmployeeCategory_Category" required type="text" name="EmployeeCategory" class="form-control input-sm" placeholder="EmployeeCategory">
                <label id="EmployeeCategoryError"></label>

            </div>
        </div>

    </div>

</div>

<div class="row">
    <div class="box-header pull-right">
        <button id="InsertEmployeeCategoryBtn" onclick="insertEmployeeCategory()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>

        <button onclick="ShowEmployeeCategory()" class="btn  btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button id="UpdateEmployeeCategoryBtn" onclick="updateEmployeeCategory()" class="btn  btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>

    </div>

</div>


<div style="overflow-x:scroll">


    <div class="modal fade" id="EmployeeCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">

                        <b> Edit Employee Category </b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
                <div class="modal-body">
                    <input type="hidden" name="EmployeeCategory_id" id="EmployeeCategory_id">

                    <div class="box-body">
                        <div id="here_show_table_content_employee_Category">
                            <table id="user_type_table" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Category</th>
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