<br> <br>
<div class="row">
    <div class="col-md-8">
        <input type="hidden" id="Id">

        <div class="row form-horizontal">

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Name</label>
                <div class="col-sm-8">
                    <input id="EmployeeName" required type="text" name="EmployeeName" class="form-control input-sm" placeholder="Name">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">اسم</label>
                <div class="col-sm-8">
                    <input id="EmployeeName_Arabic" required type="text" name="EmployeeName_Arabic" class="form-control input-sm" placeholder="اسم">
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Category</label>
                <div class="col-sm-8">
                    <select id="EmployeeCategory" required type="number" name="EmployeeCategory" class="form-control input-sm select2">

                        <option selected disabled value="">Employee Category...</option>

                        @foreach($EmployeeCategory as $obj)
                        <option>{{$obj['EmployeeCategory']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8">
                    <input id="Address" required type="text" name="Address" class="form-control input-sm" placeholder="Address ">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Cell</label>
                <div class="col-sm-8">
                    <input id="Cell" required type="text" name="Cell" class="form-control input-sm" placeholder="Cell ">
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Balance</label>
                <div class="col-sm-8">
                    <input id="Balance" required type="number" name="Balance" class="form-control input-sm" placeholder="Balance ">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Working Hour</label>
                <div class="col-sm-8">
                    <input id="WorkingHour" required type="text" name="WorkingHour" class="form-control input-sm" placeholder="Working Hour ">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Hiring Date</label>
                <div class="col-sm-8">
                    <input id="HiringDate" required type="date" name="HiringDate" class="form-control input-sm" placeholder="HiringDate ">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Fire Date</label>
                <div class="col-sm-8">
                    <input id="FireDate" required type="date" name="FireDate" class="form-control input-sm" placeholder="Fire Date">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Nationality</label>
                <div class="col-sm-8">
                    <input id="Nationality" required type="text" name="Nationality" class="form-control input-sm" placeholder="Nationality ">
                </div>
            </div>



            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Basic Salary</label>
                <div class="col-sm-8">
                    <input id="BasicSalaryAllowance" required type="number" name="BasicSalaryAllowance" class="form-control input-sm" placeholder="Basic Salary ">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Transport Allowance</label>
                <div class="col-sm-8">
                    <input id="TransportAllowance" required type="number" name="TransportAllowance" class="form-control input-sm" placeholder="Transport Allounce ">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Food Allowance</label>
                <div class="col-sm-8">
                    <input id="FoodAllowance" required type="number" name="FoodAllowance" class="form-control input-sm" placeholder="Food Allounce ">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Accomodation Allounce</label>
                <div class="col-sm-8">
                    <input id="AccomodationAllowance" required type="number" name="AccomodationAllowance" class="form-control input-sm" placeholder="Accomodation Allounce ">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">PR Allounce</label>
                <div class="col-sm-8">
                    <input id="PRAllowance" required type="number" name="PRAllowance" class="form-control input-sm" placeholder="PR Allowance ">
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Extra Allounce</label>
                <div class="col-sm-8">
                    <input id="ExtraAllowance" required type="number" name="ExtraAllowance" class="form-control input-sm" placeholder="Extra Allounce ">
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Passport No.</label>
                <div class="col-sm-4">
                    <input id="PassportNo" required type="text" name="PassportNo" class="form-control input-sm" placeholder="Passport No. ">
                </div>

                <div class="col-sm-4">
                    <div class="input-group">
                        <input id="PassportExpiryDate" required type="date" name="PassportExpiryDate" class="form-control input-sm" placeholder="Passport Expiry Date">
                        <span class="input-group-addon">Expiry</span>

                    </div>
                </div>


            </div>

            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Muncipilaty Card</label>
                <div class="col-sm-4">
                    <input id="MuncipalityCard" required type="text" name="MuncipalityCard" class="form-control input-sm" placeholder="Muncipality Card ">
                </div>

                <div class="col-sm-4">
                    <div class="input-group">
                        <input id="MuncipalityCardExpiryDate" required type="date" name="MuncipalityCardExpiryDate" class="form-control input-sm" placeholder="Muncipality Card Expiry Date ">
                        <span class="input-group-addon">Expiry</span>

                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Driving License</label>
                <div class="col-sm-4">
                    <input id="DrivingLicense" required type="text" name="DrivingLicense" class="form-control input-sm" placeholder="Driving License ">
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input id="DrivingLicenseExpiryDate" required type="date" name="DrivingLicenseExpiryDate" class="form-control input-sm" placeholder="Driving License Expiry Date ">
                        <span class="input-group-addon">Expiry</span>

                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-4 control-label">Work Permit</label>
                <div class="col-sm-4">
                    <input id="WorkPermit" required type="text" name="WorkPermit" class="form-control input-sm" placeholder="Work Permit ">
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input id="WorkPermitExpiryDate" required type="date" name="WorkPermitExpiryDate" class="form-control input-sm" placeholder="Work Permit Expiry Date ">
                        <span class="input-group-addon">Expiry</span>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-4">
        <div class="row">

            <div class="col-md-12">


                <div class="form-group">
                    <label class="button" for="Document_Images">
                        Choose file
                    </label>
                    <input type="hidden" id="Document_hidden_Images">
                    <input multiple id="Document_Images" type="file" name="Document_Images">

                    <div id="abc" style="display: flex; flex-wrap:wrap; justify-content:start;margin-bottom:20px" class="form-group">

                    </div>
                </div>


            </div>
        </div>

    </div>

</div>

<div class="row">

    <div class=" pull-right">
        <button id="InsertEmployeeBtn" onclick="insertEmployee()" class="btn  btn-default">
            <i class="fa fa-fw fa-save"></i> Save
        </button>

        <button onclick="ShowEmployees()" class="btn  btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button id="UpdateEmployeeBtn" onclick="updateEmployee()" class="btn  btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>

    </div>
</div>


<div class="modal fade" id="AllEmployeesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" style="width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <b> Employees </b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>

            </div>
            <div class="modal-body">
                <input type="hidden" name="EmployeeCategory_id" id="EmployeeCategory_id">
                <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf -->

                <div class="box-body">
                    <div style="overflow-x: scroll;" id="here_show_table_content_Employee">


                        <table id="AllEmployees_Table_Id" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Cell</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Hire Date</th>
                                    <th scope="col">Nationality</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="AllEmployees">


                            </tbody>
                    </div>
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