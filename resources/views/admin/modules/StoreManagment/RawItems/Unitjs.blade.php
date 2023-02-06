<script>
    $(".loader").hide();

    var page_number = 1;
    variable_id_for_edit = "";
    var updated_ids_array = [];
    // data_table_pagination_Unit();

    function data_table_pagination_Unit() {
        $(function() {
            var table = $("#Unit_Table").DataTable({
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

    function ShowUnits() {
        $("#AllUnitsModal").modal("show");
        $.ajax({
            url: "/Unit_1",
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
                                    <td>${el.Unit}</td>

                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedUnitData('${el.id}')">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="DeleteUnit('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
                    });

                    document.getElementById("here_show_table_content_Unit").innerHTML =
                        "";

                    var table = `
                        <table id="Unit_Table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_Unit">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_Unit"
                    ).innerHTML = table;

                    data_table_pagination_Unit();

                    document.getElementById("abc_Unit").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }
                }
            }
        });
    }



    document.getElementById("UnitError").style.display = "none";

    function insertUnit() {
        var Unit = document.getElementById("Unit_Unit").value;
        var token = "{{csrf_token()}}";
        $.ajax({
            url: "/insertUnit",
            type: "post",
            data: {
                Unit: Unit,
                _token: token
            },
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == "inserted") {
                    $('.loader').hide()
                    clear_input_fields_Unit();

                    var output = `
                <div class="alert alert-success">
                <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                Saved Successfuly
                </div>    
                        `;
                    document.getElementById(
                        "Unit_updated_status"
                    ).innerHTML = output;
                }
            }
        });

       
    }

    function getSelectedUnitData(id) {
        if (id != "") {
            // clear_input_fields();
            $("#AllUnitsModal").modal("hide");
            $.ajax({
                url: "/UnitEdit",
                type: "get",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $(".loader").show();
                },

                success: function(data) {
                    console.log(data);
                    $('.loader').hide()
                    document.getElementById("Unit_Id").value = data.id;
                    document.getElementById("Unit_Unit").value = data.Unit;

                    $("#AllUnitsModal").modal("hide");
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function DeleteUnit(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            $.ajax({
                url: "/UnitDelete",
                type: "get",
                data: {
                    id: id
                },
                beforeSend : function(){
                    $('.loader').show()
                },
                success: function(data) {
                    console.log(data);
                    if (data == "deleted") {
                        $('.loader').hide()
                        ShowUnits()
                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "Unit_deleted_status"
                        ).innerHTML = output;
                    }
                }
            });
        }
    }

    function UpdateUnit() {
        var formData = new FormData();
        formData.append("Unit", document.getElementById("Unit_Unit").value);

        formData.append("id", document.getElementById("Unit_Id").value);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/updateUnit",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                clear_input_fields_Unit();
                if (data == "updated") {
                    $('.loader').hide()
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "Unit_updated_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function clear_input_fields_Unit() {
        document.getElementById("Unit_Unit").value = "";
    }
</script>