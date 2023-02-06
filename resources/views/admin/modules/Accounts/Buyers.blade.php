@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Buyers</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="box box-default">

                    <div class="box-body">


                        <div class="row form-horizontal">
                            <input type="hidden" name="Buyer_id" id="Buyer_id">
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Account Name</label>
                                    <div class="col-md-8">

                                        <input id="AccountName_Buyer" required type="text" name="AccountName_Buyer" class="form-control input-sm" placeholder="Account Name">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Account Name Arabic</label>
                                    <div class="col-md-8">

                                        <input id="AccountName_Arabic" required type="text" name="AccountName_Arabic" class="form-control input-sm" placeholder="AccountName_Arabic">
                                    </div>
                                </div>

                                <input type="hidden" value="Buyer" id="AccountType_buyer" name="AccountType">

                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Balance</label>
                                    <div class="col-md-8">

                                        <input id="Balance" required type="number" name="Balance" class="form-control input-sm" placeholder="Balance">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Cell</label>
                                    <div class="col-md-8">

                                        <input id="Cell" required type="number" name="Cell" class="form-control input-sm" placeholder="Cell">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Contact Person</label>
                                    <div class="col-md-8">

                                        <input id="ContactPerson" required type="text" name="ContactPerson" class="form-control input-sm" placeholder="ContactPerson">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Address</label>
                                    <div class="col-md-8">

                                        <input id="Address" required type="text" name="Address" class="form-control input-sm" placeholder="Address">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">VatNo</label>
                                    <div class="col-md-8">

                                        <input id="VatNo" required type="text" name="VatNo" class="form-control input-sm" placeholder="VatNo">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Bank Detail</label>
                                    <div class="col-md-8">

                                        <input id="BankDetail" required type="text" name="BankDetail" class="form-control input-sm" placeholder="BankDetail">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-header">
                            <div class="pull-right">
                                <button id="InsertBuyerBtn" onclick="insertBuyers()" class="btn btn-default">
                                    <i class="fa fa-fw fa-save"></i> Save
                                </button>
                                <button onclick="ShowBuyers()" class="btn btn-default">
                                    <i class="fa fa-fw fa-eye"></i> Show
                                </button>
                                <button id="UpdateBuyerBtn" onclick="UpdateBuyers()" class="btn btn-default">
                                    <i class="fa fa-fw fa-refresh"></i> Update
                                </button>

                            </div>

                        </div>
                        <!-- </form> -->

                        <div style="overflow-x:scroll">

                            <div class="modal fade" id="BuyersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" style="width: 80%;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">

                                                <b> Edit Buyers </b>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>

                                        </div>
                                        <div class="modal-body">


                                            <div class="box-body">
                                                <div id="here_show_table_content_buyers">
                                                    <table id="Buyers_Suppliers_table" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Account Name</th>
                                                                <th>Account Name Arabic</th>
                                                                <th>Account Type</th>
                                                                <th>Balance</th>
                                                                <th>Cell</th>
                                                                <th>Contact Person</th>
                                                                <th>Address</th>
                                                                <th>VAT No.</th>
                                                                <th>Bank Detail</th>
                                                                <th scope="col">Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>


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
                </div>

            </div>
        </div>

    </section>

</div>

@include('admin/modules/Accounts/Buyersjs')
@endsection