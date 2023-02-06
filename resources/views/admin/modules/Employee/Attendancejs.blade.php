<script>
    $(".loader").hide();

var page_number = 1;
variable_id_for_edit = "";
var updated_ids_array = [];
data_table_pagination_attendance();

function data_table_pagination_attendance() {
    $(function() {
        var table = $("#Attendance_table").DataTable({
            drawCallback: function() {
                $(
                    ".paginate_button",
                    this.api()
                        .table()
                        .container()
                ).on("click", function(data) {
                    // console.log(data.currentTarget.innerText);
                    page_number = data.currentTarget.innerText;
                });
            }
        });
        table.page(page_number - 1).draw("page");
    });
}

function showUpdated_Attendance() {
    $.ajax({
        url: "/Attendance_1",
        type: "get",

        success: function(data) {
            console.log(data);
            var tr = ``;
            data.forEach(el => {
                tr += `
                <tr>
                                    <td>${el.Date}</td>
                                    <td>${el.EmployeeName}</td>
                                    <td>${el.Attendance}</td>
                                    <td>${el.InTime}</td>
                                    <td>${el.OutTime}</td>
                                    <td>${el.WorkingHours}</td>

                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit('${el.id}',this.id)">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="confirmToDelete('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
            });

            document.getElementById(
                "here_show_table_content_Attendance"
            ).innerHTML = "";

            var table = `
                        <table id="Attendance_table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Attendance</th>
                                    <th scope="col">In Time</th>
                                    <th scope="col">Out Time</th>
                                    <th scope="col">Working Hours</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_Attendance">


                            </tbody>
                        </table>
`;

            document.getElementById(
                "here_show_table_content_Attendance"
            ).innerHTML = table;

            data_table_pagination_attendance();

            document.getElementById("abc_Attendance").innerHTML = tr;

            for (var a = 0; a < updated_ids_array.length; a++) {
                document.getElementById(updated_ids_array[a]).style =
                    "color:red;cursor:pointer";
            }
        }
    });
}

function insertAttendance() {
    var InTime = document.getElementById("InTime").value;
    var OutTime = document.getElementById("OutTime").value;

    console.log(parseFloat(OutTime) - parseFloat(InTime));

    var Date = document.getElementById("Date").value;
    var EmployeeName = document.getElementById("EmployeeName_Attendance").value;
    var Attendance = document.getElementById("Attendance").value;

    var token = document.getElementById("token").value;
    $.ajax({
        url: "/insertAttendance",
        type: "post",
        data: {
            Date: Date,
            EmployeeName: EmployeeName,
            Attendance: Attendance,
            InTime: InTime,
            OutTime: OutTime,
            _token: token
        },
        success: function(data) {
            console.log(data);
            if (data == "inserted") {
                document.getElementById("Attendance").value = "";
                showUpdated_Attendance();
            }
        }
    });
}

function confirmToDelete(id) {
    var status = confirm("Want to delete ?");
    if (status) {
        // location.href = value;
        $.ajax({
            url: "/AttendanceDelete",
            type: "get",
            data: {
                id: id
            },
            success: function(data) {
                // console.log(data)
                if (data == "deleted") {
                    var index = updated_ids_array.indexOf("id_" + id);
                    if (index != -1) {
                        updated_ids_array.splice(index, 1);
                    }
                    alert("Attendance is deleted successfully !");
                    showUpdated_Attendance();
                }
            }
        });
    }
}

function updateAttendance() {
    var Date = document.getElementById("modal_Date").value;
    var EmployeeName = document.getElementById("modal_EmployeeName").value;
    var Attendance = document.getElementById("modal_Attendance").value;
    var InTime = document.getElementById("modal_InTime").value;
    var OutTime = document.getElementById("modal_OutTime").value;
    var Attendance_id = document.getElementById("Attendance_id").value;
    var token = document.getElementById("token").value;
    $.ajax({
        url: "/updateAttendance",
        type: "post",
        data: {
            Date: Date,
            EmployeeName: EmployeeName,
            Attendance: Attendance,
            InTime: InTime,
            OutTime: OutTime,
            id: Attendance_id,
            _token: token
        },
        success: function(data) {
            console.log(data);
            if (data == "updated") {
                document.getElementById("modal_Attendance").value = "";
                $("#Attendance_modal").modal("hide");
                updated_ids_array.push(variable_id_for_edit);
                showUpdated_Attendance();
            } else {
                $("#Attendance_modal").modal("hide");
            }
        }
    });
}

function getValueForEdit(id, id_for_edit) {
    variable_id_for_edit = id_for_edit;

    $.ajax({
        url: "/AttendanceEdit",
        type: "get",
        data: {
            id: id
        },
        beforeSend: function() {
            $(".loader").show();
        },

        success: function(data) {
            console.log(data);
            if (data != "") {
                document.getElementById("Attendance_id").value = data.id;
                document.getElementById("modal_Date").value = data.Date;
                document.getElementById("modal_EmployeeName").value =
                    data.EmployeeName;
                // document.getElementById("modal_Attendance").value = data.Attendance;
                var Attendance = "";
                Attendance += `<option ${
                    data.Attendance == "Present" ? "selected" : ""
                }>Present</option>`;
                Attendance += `<option ${
                    data.Attendance == "Absent" ? "selected" : ""
                }>Absent</option>`;
                Attendance += `<option ${
                    data.Attendance == "Leave" ? "selected" : ""
                }>Leave</option>`;
                Attendance += `<option ${
                    data.Attendance == "PresenPaid Leave" ? "selected" : ""
                }>Paid Leave</option>`;
                document.getElementById(
                    "modal_Attendance"
                ).innerHTML = Attendance;
                console.log(Attendance);

                document.getElementById("modal_InTime").value = data.InTime;
                document.getElementById("modal_OutTime").value = data.OutTime;
                $("#Attendance_modal").modal("show");
                $(".loader").hide();
            } else {
                $(".loader").show();
            }
        },
        error: function(req, status, error) {
            console.log(error);
        }
    });
}

</script>