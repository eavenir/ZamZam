<div class="row form-horizontal">
    <div class="col-md-8">
        <input type="hidden" name="Account_id" id="Account_id">
        <div class="form-group">
            <label for="" class="control-label col-md-4">Account</label>
            <div class="col-md-8">

                <input id="AccountName" required type="text" name="AccountName" class="form-control input-sm" placeholder="Account Name">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label col-md-4">Account Detail</label>
            <div class="col-md-8">

                <input id="AccountDetail" required type="text" name="AccountDetail" class="form-control input-sm" placeholder="AccountDetail">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label col-md-4">Opening Balance</label>
            <div class="col-md-8">

                <input id="OpeningBalance" required type="number" name="OpeningBalance" class="form-control input-sm" placeholder="OpeningBalance">
            </div>
        </div>
    </div>


</div>
<div class="box-header">
    <div class="pull-right">
        <button id="InsertBankBtn" onclick="insertAccount()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>
        <button onclick="ShowBanks()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button id="UpdateBankBtn" onclick="UpdateBank()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>

    </div>


</div>
<!-- </form> -->

<div style="overflow-x:scroll">


    <div class="modal fade" id="BankModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        
                   <b> Edit Bank Account </b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
                    
                </div>
                <div class="modal-body">

                    <div class="box-body">
                        <div id="here_show_table_content_bank">
                            <table id="bank_table" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Account</th>
                                        <th>Account Detail</th>
                                        <th>Opening Balance</th>
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