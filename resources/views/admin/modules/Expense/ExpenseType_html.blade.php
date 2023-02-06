<div class="row form-horizontal">
    <div class="col-md-8">
        <input type="hidden" name="ExpenseType_id" id="ExpenseType_id">
        <div class="form-group">
            <label for="" class="control-label col-md-4">Expense Type</label>
            <div class="col-md-8">

                <input id="ExpenseType" required type="text" name="ExpenseType" class="form-control input-sm" placeholder="Expense Type">
            </div>
        </div>


    </div>


</div>
<div class="box-header">
    <div class="pull-right">
        <button id="InsertExpenseTypeBtn" onclick="insertExpenseType()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>
        <button onclick="ShowExpenseType()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button id="UpdateExpenseTypeBtn" onclick="UpdateExpenseType()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>

    </div>


</div>
<!-- </form> -->

<div style="overflow-x:scroll">


    <div class="modal fade" id="ExpenseTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">

                        <b> Edit Expense Type </b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
                <div class="modal-body">

                    <div class="box-body">
                        <div id="here_show_table_content_expense_type">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Expense Type</th>

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