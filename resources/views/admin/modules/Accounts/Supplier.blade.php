@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Suppliers</h1>
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
                            <input type="hidden" name="supplier_id" id="supplier_id">
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Account Name</label>
                                    <div class="col-md-8">

                                        <input id="AccountName_supplier" required type="text" name="AccountName_supplier" class="form-control input-sm" placeholder="Account Name">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Account Name Arabic</label>
                                    <div class="col-md-8">

                                        <input id="AccountName_Arabic_supplier" required type="text" name="AccountName_Arabic" class="form-control input-sm" placeholder="AccountName_Arabic">
                                    </div>
                                </div>

                                <input type="hidden" id="AccountType_supplier" name="AccountType" value="Supplier">


                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Balance</label>
                                    <div class="col-md-8">

                                        <input id="Balance_supplier" required type="number" name="Balance" class="form-control input-sm" placeholder="Balance">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Cell</label>
                                    <div class="col-md-8">

                                        <input id="Cell_supplier" required type="number" name="Cell" class="form-control input-sm" placeholder="Cell">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Contact Person</label>
                                    <div class="col-md-8">

                                        <input id="ContactPerson_supplier" required type="text" name="ContactPerson" class="form-control input-sm" placeholder="ContactPerson">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Address</label>
                                    <div class="col-md-8">

                                        <input id="Address_supplier" required type="text" name="Address" class="form-control input-sm" placeholder="Address">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">VatNo</label>
                                    <div class="col-md-8">

                                        <input id="VatNo_supplier" required type="text" name="VatNo" class="form-control input-sm" placeholder="VatNo">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Bank Detail</label>
                                    <div class="col-md-8">

                                        <input id="BankDetail_supplier" required type="text" name="BankDetail" class="form-control input-sm" placeholder="BankDetail">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-header">
                            <div class="pull-right">
                                <button id="InsertSupplierBtn" onclick="insertsupplier()" class="btn btn-default">
                                    <i class="fa fa-fw fa-save"></i> Save
                                </button>
                                <button onclick="Showsuppliers()" class="btn btn-default">
                                    <i class="fa fa-fw fa-eye"></i> Show
                                </button>
                                <button id="UpdateSupplierBtn" onclick="Updatesupplier()" class="btn btn-default">
                                    <i class="fa fa-fw fa-refresh"></i> Update
                                </button>

                            </div>

                        </div>
                        <!-- </form> -->

                        <div style="overflow-x:scroll">

                            <div class="modal fade" id="SuppliersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" style="width: 80%;" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                <b> Edit suppliers </b>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h5>

                                        </div>
                                        <div class="modal-body">


                                            <div class="box-body">
                                                <div id="here_show_table_content_supplier">
                                                    <table id="suppliers_Suppliers_table" class="table">
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

@include('admin/modules/Accounts/Supplierjs')
@endsection