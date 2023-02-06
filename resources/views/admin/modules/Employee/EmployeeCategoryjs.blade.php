<script>
    $(".loader").hide();

    document.getElementById('UpdateEmployeeCategoryBtn').disabled = true

    var page_number = 1;
    variable_id_for_edit = "";
    var updated_ids_array = [];
    data_table_pagination_employee_category();

    function data_table_pagination_employee_category() {
        $(function() {
            var table = $("#employee_category_table").DataTable({
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

    function ShowEmployeeCategory() {
        $('#EmployeeCategoryModal').modal('show')
        $.ajax({
            url: "/EmployeeCategory_1",
            type: "get",
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                if (data) {

                    $('.loader').hide()
                    var tr = ``;
                    data.forEach(el => {
                        tr += `
                <tr>
                                    <td>${el.EmployeeCategory}</td>

                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_category('${el.id}',this.id)">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="confirmToDelete_employeeCategory('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
                    });

                    document.getElementById("here_show_table_content_employee_Category").innerHTML = "";

                    var table = `
                        <table id="employee_category_table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">EmployeeCategory</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_employee_category">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_employee_Category"
                    ).innerHTML = table;

                    data_table_pagination_employee_category();

                    document.getElementById("abc_employee_category").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }
                }
            }
        });
    }


    document.getElementById("EmployeeCategoryError").style.display = "none";

    function insertEmployeeCategory() {
        var EmployeeCategory = document.getElementById("EmployeeCategory_Category").value;
        var token = document.getElementById('token').value;
        $.ajax({
            url: "/insertEmployeeCategory",
            type: "post",
            data: {
                EmployeeCategory: EmployeeCategory,
                _token: token
            },
            beforeSend: function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == "inserted") {
                    $('.loader').hide()
                    document.getElementById("EmployeeCategory_Category").value = "";
                    // showUpdated_EmployeeCategory();
                }
            }
        });


    }

    function confirmToDelete_employeeCategory(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            // location.href = value;
            $.ajax({
                url: "/EmployeeCategoryDelete",
                type: "get",
                data: {
                    id: id
                },
                beforeSend : function(){
                    $('.loader').show()
                },
                success: function(data) {
                    // console.log(data)
                    if (data == "deleted") {
                        $('.loader').hide()
                        var index = updated_ids_array.indexOf("id_" + id);
                        if (index != -1) {
                            updated_ids_array.splice(index, 1);
                        }
                        alert("EmployeeCategory is deleted successfully !");
                        ShowEmployeeCategory();
                    }
                }
            });
        }
    }

    document.getElementById("updateEmployeeCategoryError").style.display = "none";

    function updateEmployeeCategory() {
        var EmployeeCategory = document.getElementById("EmployeeCategory_Category").value;
        var EmployeeCategory_id = document.getElementById("EmployeeCategory_id")
            .value;
        var token = document.getElementById('token').value;
        $.ajax({
            url: "/updateEmployeeCategory",
            type: "post",
            data: {
                EmployeeCategory: EmployeeCategory,
                id: EmployeeCategory_id,
                _token: token
            },
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                if (data == "updated") {
                    $('.loader').hide()
                    document.getElementById('UpdateEmployeeCategoryBtn').disabled = true
                    document.getElementById('InsertEmployeeCategoryBtn').disabled = false

                    document.getElementById("EmployeeCategory_Category").value = "";
                    updated_ids_array.push(variable_id_for_edit);
                    // ShowEmployeeCategory();
                }
            }
        });
    }

    function getValueForEdit_category(id, id_for_edit) {
        document.getElementById('UpdateEmployeeCategoryBtn').disabled = false
        document.getElementById('InsertEmployeeCategoryBtn').disabled = true

        document.getElementById("EmployeeCategory_id").value = id;
        variable_id_for_edit = id_for_edit;
        $.ajax({
            url: "/EmployeeCategoryEdit",
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
                    $('#EmployeeCategoryModal').modal('hide')
                    document.getElementById("EmployeeCategory_id").value = data.id;
                    document.getElementById("EmployeeCategory_Category").value =
                        data.EmployeeCategory;
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