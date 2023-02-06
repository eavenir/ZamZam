<div class="row form-horizontal">
    <div class="col-md-8">
        <input type="hidden" name="Cashbook_id" id="Cashbook_id">
        <div class="form-group">
            <label for="" class="control-label col-md-4">Date</label>
            <div class="col-md-8">
                <input id="Date" required type="date" name="Date" class="form-control input-sm" placeholder="Date">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label col-md-4">From Account</label>
            <div class="col-md-8">
                <select id="FromAccount" class="form-control input-sm select2">
                    <option value="" selected disabled>From Account...</option>
                    @foreach($Accounts as $Account)
                    <option value="{{$Account->AccountName}}">{{$Account->AccountName}} (Bank)</option>
                    @endforeach
                    @foreach($Buyers as $Buyer)
                    <option value="{{$Buyer->AccountName}}">{{$Buyer->AccountName}} (Buyer)</option>
                    @endforeach
                    @foreach($Suppliers as $Supplier)
                    <option value="{{$Supplier->AccountName}}">{{$Supplier->AccountName}} (Supplier)</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label col-md-4">To Account</label>
            <div class="col-md-8">
                <select id="ToAccount" class="form-control input-sm select2">
                    <option value="" disabled selected>To Account...</option>
                    @foreach($Accounts as $Account)
                    <option value="{{$Account->AccountName}}">{{$Account->AccountName}} (Bank)</option>
                    @endforeach
                    @foreach($Buyers as $Buyer)
                    <option value="{{$Buyer->AccountName}}">{{$Buyer->AccountName}} (Buyer)</option>
                    @endforeach
                    @foreach($Suppliers as $Supplier)
                    <option value="{{$Supplier->AccountName}}">{{$Supplier->AccountName}} (Supplier)</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label col-md-4">Amount</label>
            <div class="col-md-8">
                <input id="Amount" required type="number" name="Amount" class="form-control input-sm" placeholder="Amount">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label col-md-4">Remarks</label>
            <div class="col-md-8">
                <textarea id="Remarks" rows="8" name="Remarks" class="form-control input-sm">

                </textarea>
            </div>
        </div>


    </div>


</div>
<div class="box-header">
    <div class="pull-right">
        <button id="InsertCashbookBtn" onclick="insertCashbook()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>
        <button onclick="ShowCashbook()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button id="UpdateCashbookBtn" onclick="UpdateCashbook()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>

    </div>


</div>
<!-- </form> -->

<div style="overflow-x:scroll">


    <div class="modal fade" id="CashbookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog mw-100 w-50" style="width:70%" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">

                        <b> Edit Cashbook </b>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>

                </div>
                <div class="modal-body">

                    <div class="box-body">
                        <div id="here_show_table_content_Cashbook">
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