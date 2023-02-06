<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Date</label>
            <input id="Date" required type="date" name="Date" class="form-control" placeholder="Date">
            <label id="DateError"></label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">Employee Name</label>
            <input id="EmployeeName_Attendance" required type="text" name="EmployeeName" class="form-control"
                placeholder="EmployeeName">
            <label id="EmployeeNameError"></label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="">Attendance</label>
            <select id="Attendance" style="width: 100%;" name="Attendance" class="form-control select2">
                <option value="" selected disabled>Attendance...</option>
                <option>Present</option>
                <option>Absent</option>
                <option>Leave</option>
                <option>Paid Leave</option>
            </select>
        </div>
    </div>



    <div class="col-md-3">
        <div class="form-group">
            <label for="">In Time</label>
            <input id="InTime" required type="time" name="InTime" class="form-control" placeholder="InTime">
            <label id="InTimeError"></label>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="">Out Time</label>
            <input id="OutTime" required type="time" name="OutTime" class="form-control" placeholder="OutTime">
            <label id="OutTimeError"></label>
        </div>
    </div>


    <div class="col-md-2">
        <button onclick="insertAttendance()" style="margin-top: 25px;" class="btn btn-success">
            Save
        </button>

    </div>
</div>
<!-- </form> -->

<div style="overflow-x:scroll">
    <div id="here_show_table_content_Attendance">
        <table id="Attendance_table" class="table">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Attendance</th>
                    <th scope="col">InTime</th>
                    <th scope="col">Out Time</th>
                    <th scope="col">Working Hour</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($Attendance as $obj)
                <tr>
                    <td>{{$obj['Date']}}</td>
                    <td>{{$obj['EmployeeName']}}</td>
                    <td>{{$obj['Attendance']}}</td>
                    <td>{{$obj['InTime']}}</td>
                    <td>{{$obj['OutTime']}}</td>
                    <td>{{$obj['WorkingHours']}}</td>

                    <td>
                        <span style="cursor: pointer;" id="id_{{$obj['id']}}"
                            onclick="getValueForEdit(`{{$obj['id']}}`,this.id)">
                            <i class="fa fa-fw fa-edit"></i> Edit
                        </span>

                        <span style="cursor: pointer;" onclick="confirmToDelete(`{{$obj['id']}}`)">
                            <i class="fa fa-fw fa-eraser"></i> Delete
                        </span>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="Attendance_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog mw-100 w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Attendace</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Attendance_id" id="Attendance_id">
                    <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                    @csrf -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input style="width:100%" type="text" id="modal_Date" name="Date"
                                        class="form-control" placeholder="Date">
                                    <label id="updateDateError"></label>
                                </div>

                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Employee Name</label>
                                    <input style="width:100%" type="text" id="modal_EmployeeName" name="EmployeeName"
                                        class="form-control" placeholder="EmployeeName">
                                    <label id="upEmployeeNameError"></label>
                                </div>

                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Attendance</label>
                                    <select id="modal_Attendance" style="width: 100%;" name="Attendance"
                                        class="form-control select2">

                                    </select>
                                </div>
                            </div>



                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">In Time</label>
                                    <input id="modal_InTime" required type="time" name="InTime" class="form-control"
                                        placeholder="InTime">
                                    <label id="InTimeError"></label>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="">Out Time</label>
                                    <input id="modal_OutTime" required type="time" name="OutTime" class="form-control"
                                        placeholder="OutTime">
                                    <label id="OutTimeError"></label>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <button onclick="updateAttendance()" style=" margin-top: 25px;" class="btn btn-primary">
                                    Update
                                </button>

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