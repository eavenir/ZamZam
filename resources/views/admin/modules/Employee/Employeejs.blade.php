<script>
    $(".loader").hide();
    document.getElementById('UpdateEmployeeBtn').disabled = true

    let Document_Images_input = document.getElementById("Document_Images");
    let Document_Images_img = "";
    var _URL = window.URL || window.webkitURL;
    var images_array = [];
    var images_array_update = [];
    var delete_images_array = [];
    Document_Images_input.addEventListener("change", () => {
        let file = Document_Images_input.files;
        for (var a = 0; a < file.length; a++) {
            images_array.push({
                id: a,
                file: file[a]
            });
        }

        show_doucment_images();
    });

    function deleteImage(id) {
        for (var a = 0; a < images_array.length; a++) {
            if (id == images_array[a].id) {
                console.log("yes");
                images_array.splice(a, 1);
                break;
            }
        }
        show_doucment_images();
    }

    function deleteImage_update(id) {
        for (var a = 0; a < images_array_update.length; a++) {
            if (id == images_array_update[a].id) {
                delete_images_array.push({
                    id: images_array_update[a].id,
                    Employee_Id: images_array_update[a].Employee_Id
                });
                images_array_update.splice(a, 1);
                break;
            }
        }
        show_doucment_images();
    }

    function show_doucment_images() {
        document.getElementById("abc").innerHTML = "";
        for (var a = 0; a < images_array.length; a++) {
            document.getElementById("abc").innerHTML += `


        


<div style="position:relative;margin-top:5px; margin-right:5px" class="image_box">
<span onclick="deleteImage(${images_array[a].id})" style="z-index: 1;position: absolute;right: 0;cursor:pointer" class="label label-warning"><i class="fa fa-remove"></i></span>

<img style="width:100px;position:relative;" src='${URL.createObjectURL(images_array[a].file)}'>
<div style="width:100%;background-color: lightgrey;text-align: center;">
<i style="cursor:pointer" class="fa fa-cloud-download"></i>
</div>
        

</div>`;
        }

        for (var a = 0; a < images_array_update.length; a++) {
            document.getElementById("abc").innerHTML += `
<div style="position:relative;margin-top:5px; margin-right:5px" class="image_box">
<span onclick="deleteImage_update(${images_array_update[a].id})" style="z-index: 1;position: absolute;right: 0;cursor:pointer" class="label label-warning"><i class="fa fa-remove"></i></span>
<img style="width:100px;position:relative;" src='${images_array_update[a].Document_Images}'>
<div style="width:100%;background-color: lightgrey;text-align: center;">
<i style="cursor:pointer" class="fa fa-cloud-download"></i>
</div>
</div>`;
        }
    }

    function EditEmployee() {
        $("#EditEmployeeModal").modal("show");
    }

    function getSelectedEmployeeData(id) {
        document.getElementById('UpdateEmployeeBtn').disabled = false
        document.getElementById('InsertEmployeeBtn').disabled = true

        if (id != "") {
            $('#AllEmployeesModal').modal('hide')
            $.ajax({
                url: "/EmployeeEdit",
                type: "get",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $(".loader").show();
                },

                success: function(data) {
                    if (data) {
                        $('.loader').hide()

                        images_array = [];
                        images_array_update = [];

                        $("#getSelectedEmployee")
                            .val("")
                            .trigger("change");
                        console.log(data);
                        document.getElementById("Id").value = data.EmployeeData.Id;
                        document.getElementById("EmployeeName").value =
                            data.EmployeeData.EmployeeName;
                        document.getElementById("EmployeeName_Arabic").value =
                            data.EmployeeData.EmployeeName_Arabic;
                        document.getElementById("EmployeeCategory").value =
                            data.EmployeeData.EmployeeCategory;
                        document.getElementById("Address").value =
                            data.EmployeeData.Address;
                        document.getElementById("Cell").value = data.EmployeeData.Cell;
                        document.getElementById("Balance").value =
                            data.EmployeeData.Balance;
                        document.getElementById("WorkingHour").value =
                            data.EmployeeData.WorkingHour;
                        document.getElementById("HiringDate").value =
                            data.EmployeeData.HiringDate;
                        document.getElementById("FireDate").value =
                            data.EmployeeData.FireDate;
                        document.getElementById("Nationality").value =
                            data.EmployeeData.Nationality;
                        document.getElementById("BasicSalaryAllowance").value =
                            data.EmployeeData.BasicSalaryAllowance;
                        document.getElementById("TransportAllowance").value =
                            data.EmployeeData.TransportAllowance;
                        document.getElementById("FoodAllowance").value =
                            data.EmployeeData.FoodAllowance;
                        document.getElementById("AccomodationAllowance").value =
                            data.EmployeeData.AccomodationAllowance;
                        document.getElementById("PRAllowance").value =
                            data.EmployeeData.PRAlowance;
                        document.getElementById("ExtraAllowance").value =
                            data.EmployeeData.ExtraAllowance;
                        document.getElementById("PassportNo").value =
                            data.EmployeeData.PassportNo;
                        document.getElementById("PassportExpiryDate").value =
                            data.EmployeeData.PassportExpireDate;
                        document.getElementById("MuncipalityCard").value =
                            data.EmployeeData.MuncipalityCard;
                        document.getElementById("MuncipalityCardExpiryDate").value =
                            data.EmployeeData.MuncipalityCardExpiryDate;
                        document.getElementById("DrivingLicense").value =
                            data.EmployeeData.DrivingLicense;
                        document.getElementById("DrivingLicenseExpiryDate").value =
                            data.EmployeeData.DrivingLicenseExpiryDate;
                        document.getElementById("WorkPermit").value =
                            data.EmployeeData.WorkPermit;
                        document.getElementById("WorkPermitExpiryDate").value =
                            data.EmployeeData.WorkPermitExpiryDate;

                        images_array = [];

                        for (var a = 0; a < data.EmployeeDocuments.length; a++) {
                            // console.log(data.EmployeeDocuments[a].Document_Images)
                            images_array_update.push(data.EmployeeDocuments[a]);
                        }

                        show_doucment_images();

                        $("#EditEmployeeModal").modal("hide");
                    }
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function insertEmployee() {
        var EmployeeName = document.getElementById('EmployeeName').value;
        var EmployeeName_Arabic = document.getElementById('EmployeeName_Arabic').value;
        var EmployeeCategory = document.getElementById('EmployeeCategory').value;
        var HiringDate = document.getElementById('HiringDate').value;
        var PassportNo = document.getElementById('PassportNo').value;

        if (EmployeeName == '') {
            alert("Please Fill Employee Name");
            return false
        }

        if (EmployeeName_Arabic == '') {
            alert("Please Fill Employee Name");
            return false
        }
        if (EmployeeCategory == '') {
            alert("Please Fill Employee Name In Arabic");
            return false
        }
        if (HiringDate == '') {
            alert("Please Fill Hiring Date");
            return false
        }
        if (PassportNo == '') {
            alert("Please Fill Passport No.");
            return false
        }


        var formData = new FormData();
        formData.append(
            "EmployeeName",
            document.getElementById("EmployeeName").value
        );
        formData.append(
            "EmployeeName_Arabic",
            document.getElementById("EmployeeName_Arabic").value
        );
        formData.append(
            "EmployeeCategory",
            document.getElementById("EmployeeCategory").value
        );
        formData.append("Balance", document.getElementById("Balance").value);
        formData.append("Cell", document.getElementById("Cell").value);
        formData.append("Address", document.getElementById("Address").value);
        formData.append(
            "BasicSalaryAllowance",
            document.getElementById("BasicSalaryAllowance").value
        );
        formData.append(
            "TransportAllowance",
            document.getElementById("TransportAllowance").value
        );
        formData.append(
            "FoodAllowance",
            document.getElementById("FoodAllowance").value
        );
        formData.append(
            "AccomodationAllowance",
            document.getElementById("AccomodationAllowance").value
        );
        formData.append(
            "PRAllowance",
            document.getElementById("PRAllowance").value
        );
        formData.append(
            "ExtraAllowance",
            document.getElementById("ExtraAllowance").value
        );
        formData.append(
            "WorkingHour",
            document.getElementById("WorkingHour").value
        );
        formData.append("HiringDate", document.getElementById("HiringDate").value);
        formData.append("FireDate", document.getElementById("FireDate").value);
        formData.append(
            "Nationality",
            document.getElementById("Nationality").value
        );
        formData.append("PassportNo", document.getElementById("PassportNo").value);
        formData.append(
            "PassportExpiryDate",
            document.getElementById("PassportExpiryDate").value
        );
        formData.append("WorkPermit", document.getElementById("WorkPermit").value);
        formData.append(
            "WorkPermitExpiryDate",
            document.getElementById("WorkPermitExpiryDate").value
        );
        formData.append(
            "DrivingLicense",
            document.getElementById("DrivingLicense").value
        );
        formData.append(
            "DrivingLicenseExpiryDate",
            document.getElementById("DrivingLicenseExpiryDate").value
        );
        formData.append(
            "MuncipalityCard",
            document.getElementById("MuncipalityCard").value
        );
        formData.append(
            "MuncipalityCardExpiryDate",
            document.getElementById("MuncipalityCardExpiryDate").value
        );
        formData.append(
            "AccountId", sessionStorage.getItem('Selected_Head')
        );

        for (var x = 0; x < images_array.length; x++) {
            formData.append("Document_Images[]", images_array[x].file);
        }
        formData.append("_token", "{{csrf_token()}}");

        console.log(images_array);

        var token = "{{csrf_token()}}";
        $.ajax({
            url: "/insertEmployee",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(data) {
                console.log(data);
                if (data == "inserted") {
                    $('.loader').hide();
                    clear_input_fields();
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Saved Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "show_insert_status"
                    ).innerHTML = output;

                    function_for_hiding_insert_top_status();

                    images_array = [];
                    images_array_update = [];
                }
            }
        });

        document.getElementById("EmployeeName").focus();
        document.getElementById("EmployeeName").select();
    }

    function clear_input_fields() {
        document.getElementById("EmployeeName").value = "";
        document.getElementById("EmployeeName_Arabic").value = "";
        $("#EmployeeCategory")
            .val("")
            .trigger("change");
        document.getElementById("Balance").value = "";
        document.getElementById("Cell").value = "";
        document.getElementById("Address").value = "";
        document.getElementById("BasicSalaryAllowance").value = "";
        document.getElementById("TransportAllowance").value = "";
        document.getElementById("FoodAllowance").value = "";
        document.getElementById("AccomodationAllowance").value = "";
        document.getElementById("PRAllowance").value = "";
        document.getElementById("ExtraAllowance").value = "";
        document.getElementById("WorkingHour").value = "";
        document.getElementById("HiringDate").value = "";
        document.getElementById("FireDate").value = "";
        document.getElementById("Nationality").value = "";
        document.getElementById("PassportNo").value = "";
        document.getElementById("PassportExpiryDate").value = "";
        document.getElementById("WorkPermit").value = "";
        document.getElementById("WorkPermitExpiryDate").value = "";
        document.getElementById("DrivingLicense").value = "";
        document.getElementById("DrivingLicenseExpiryDate").value = "";
        document.getElementById("MuncipalityCard").value = "";
        document.getElementById("MuncipalityCardExpiryDate").value = "";

        document.getElementById("abc").innerHTML = "";
        images_array = [];
    }

    function DeleteEmployee() {
        var status = confirm("Want to delete ?");
        if (status) {
            if (document.getElementById("Id").value) {
                $.ajax({
                    url: "/EmployeeDelete",
                    type: "get",
                    data: {
                        id: document.getElementById("Id").value
                    },
                    beforeSend: function() {
                        $('.loader').show()
                    },
                    success: function(data) {
                        // console.log(data)
                        if (data == "deleted") {
                            $('.loader').hide()
                            clear_input_fields();
                            images_array = [];
                            images_array_update = [];
                            var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                            document.getElementById(
                                "show_insert_status"
                            ).innerHTML = output;
                            function_for_hiding_insert_top_status();
                        }
                    }
                });
            } else {
                alert("Please first select Employee");
            }
        }
    }

    var page_number = 1;
    variable_id_for_edit = "";
    var updated_ids_array = [];
    // data_table_pagination_role();

    function data_table_pagination_role() {
        $(function() {
            var table = $("#Employee_Table").DataTable({
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

    function ShowEmployees() {
        $.ajax({
            url: "/ShowEmployees",
            type: "get",
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(data) {
                console.log(data);
                if (data) {
                    $('.loader').hide();

                    var tr = "";
                    data.forEach(el => {
                        tr += `
                <tr>
                <td>${el.EmployeeName} / ${el.EmployeeName_Arabic}</td>
                <td>${el.EmployeeCategory}</td>
                <td>${el.Balance}</td>
                <td>${el.Cell}</td>
                <td>${el.BasicSalaryAllowance}</td>
                <td>${el.HiringDate}</td>
                <td>${el.Nationality}</td>
    
                <td>
                    <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedEmployeeData('${el.Id}')">
                        <i class="fa fa-fw fa-edit"></i> 
                    </span>
    
                    <span style="cursor: pointer;" onclick="confirmToDelete('${el.id}')">
                        <i class="fa fa-fw fa-trash-o"></i>
                    </span>
    
                </td>
            </tr>
                `;

                    });

                    document.getElementById("here_show_table_content_Employee").innerHTML =
                        "";

                    var table = `
                        <table id="Employee_Table" class="table">
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
                            <tbody id="abc_Employee">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_Employee"
                    ).innerHTML = table;

                    data_table_pagination_role();

                    document.getElementById("abc_Employee").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }


                    $('#AllEmployeesModal').modal('show')
                }
            }
        });
    }

    function function_for_hiding_insert_top_status() {
        setTimeout(function() {
            document.getElementById("show_insert_status").innerHTML = "";
        }, 5000);
    }

    function updateEmployee() {
        var formData = new FormData();
        formData.append(
            "EmployeeName",
            document.getElementById("EmployeeName").value
        );
        formData.append(
            "EmployeeName_Arabic",
            document.getElementById("EmployeeName_Arabic").value
        );
        formData.append(
            "EmployeeCategory",
            document.getElementById("EmployeeCategory").value
        );
        formData.append("Balance", document.getElementById("Balance").value);
        formData.append("Cell", document.getElementById("Cell").value);
        formData.append("Address", document.getElementById("Address").value);
        formData.append(
            "BasicSalaryAllowance",
            document.getElementById("BasicSalaryAllowance").value
        );
        formData.append(
            "TransportAllowance",
            document.getElementById("TransportAllowance").value
        );
        formData.append(
            "FoodAllowance",
            document.getElementById("FoodAllowance").value
        );
        formData.append(
            "AccomodationAllowance",
            document.getElementById("AccomodationAllowance").value
        );
        formData.append(
            "PRAllowance",
            document.getElementById("PRAllowance").value
        );
        formData.append(
            "ExtraAllowance",
            document.getElementById("ExtraAllowance").value
        );
        formData.append(
            "WorkingHour",
            document.getElementById("WorkingHour").value
        );
        formData.append("HiringDate", document.getElementById("HiringDate").value);
        formData.append("FireDate", document.getElementById("FireDate").value);
        formData.append(
            "Nationality",
            document.getElementById("Nationality").value
        );
        formData.append("PassportNo", document.getElementById("PassportNo").value);
        formData.append(
            "PassportExpiryDate",
            document.getElementById("PassportExpiryDate").value
        );
        formData.append("WorkPermit", document.getElementById("WorkPermit").value);
        formData.append(
            "WorkPermitExpiryDate",
            document.getElementById("WorkPermitExpiryDate").value
        );
        formData.append(
            "DrivingLicense",
            document.getElementById("DrivingLicense").value
        );
        formData.append(
            "DrivingLicenseExpiryDate",
            document.getElementById("DrivingLicenseExpiryDate").value
        );
        formData.append(
            "MuncipalityCard",
            document.getElementById("MuncipalityCard").value
        );
        formData.append(
            "MuncipalityCardExpiryDate",
            document.getElementById("MuncipalityCardExpiryDate").value
        );

        for (var x = 0; x < images_array.length; x++) {
            formData.append("Document_Images[]", images_array[x].file);
        }

        for (var a = 0; a < delete_images_array.length; a++) {
            formData.append(
                "Delete_Document_Images[]",
                JSON.stringify(delete_images_array[a])
            );
        }

        formData.append("id", document.getElementById("Id").value);
        formData.append("_token", document.getElementById("token").value);

        var id = document.getElementById("Id").value;
        if (id) {
            $.ajax({
                url: "/updateEmployee",
                type: "post",
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(data) {
                    console.log(data);
                    if (data == "updated") {

                        $('.loader').hide()

                        document.getElementById('UpdateEmployeeBtn').disabled = true
                        document.getElementById('InsertEmployeeBtn').disabled = false

                        var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "show_insert_status"
                        ).innerHTML = output;
                        function_for_hiding_insert_top_status();
                        images_array_update = [];
                        images_array = [];

                        clear_input_fields();
                    }
                }
            });
        } else {
            alert("Please first select any record");
        }
    }
</script>