<script>
    $(".loader").hide();

    var page_number = 1;
    variable_id_for_edit = "";
    var updated_ids_array = [];
    // data_table_pagination_Dish();

    function data_table_pagination_Dish() {
        $(function() {
            var table = $("#Dish_Table").DataTable({
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

    function ShowDish() {
        $("#DishModal").modal("show");
        $.ajax({
            url: "/Dish_1",
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
                                    <td>${el.DishName}</td>

                                    <td>${el.DishName_Arabic}</td>

                                    <td>${el.SubMenuId}</td>

                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedDishData('${el.id}')">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="DeleteDish('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
                    });

                    document.getElementById("here_show_table_content_Dish").innerHTML =
                        "";

                    var table = `
                        <table id="Dish_Table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">Dish Name</th>
                                    <th scope="col">Dish Name Arabic</th>

                                    <th scope="col">Sub Menu</th>

                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_Dish">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_Dish"
                    ).innerHTML = table;

                    data_table_pagination_Dish();

                    document.getElementById("abc_Dish").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }
                }
            }
        });
    }

  

    function insertDish() {
        var DishName = document.getElementById("DishName").value;
        var DishName_Arabic = document.getElementById("DishName_Arabic").value;
        var SubMenu = document.getElementById("SubMenu_Dish").value;
        var token = "{{csrf_token()}}";
        $.ajax({
            url: "/insertDish",
            type: "post",
            data: {
                DishName: DishName,
                DishName_Arabic: DishName_Arabic,
                SubMenu: SubMenu,
                _token: token
            },
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == "inserted") {
                    $('.loader').hide()
                    clear_input_fields_Dish();

                    var output = `
                <div class="alert alert-success">
                <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                Saved Successfuly
                </div>    
                        `;
                    document.getElementById(
                        "Dish_updated_status"
                    ).innerHTML = output;
                }
            }
        });

    }

    function getSelectedDishData(id) {
        if (id != "") {
            // clear_input_fields();
            $("#DishModal").modal("hide");
            $.ajax({
                url: "/DishEdit",
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
                    document.getElementById("Dish_Id").value = data.Dish.id;
                    document.getElementById("DishName").value = data.Dish.DishName;
                    document.getElementById("DishName_Arabic").value = data.Dish.DishName_Arabic;

                    var SubMenu = '';
                    data.SubMenu.forEach(el => {
SubMenu +=`
<option value="${el.Id}" ${el.Id == data.Dish.SubMenuId ? 'selected' : ''}> ${el.SubMenu} </option>
`;
                    })

                    document.getElementById('SubMenu_Dish').innerHTML = SubMenu;



                    $("#DishModal").modal("hide");
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function DeleteDish(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            $.ajax({
                url: "/DishDelete",
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
                        ShowDish()
                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "Dish_deleted_status"
                        ).innerHTML = output;
                    }
                }
            });
        }
    }

    function UpdateDish() {
        var formData = new FormData();
        formData.append("DishName", document.getElementById("DishName").value);
        formData.append("DishName_Arabic", document.getElementById("DishName_Arabic").value);
        formData.append("SubMenu", document.getElementById("SubMenu_Dish").value);

        formData.append("id", document.getElementById("Dish_Id").value);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/updateDish",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                clear_input_fields_Dish();
                if (data == "updated") {
                    $('.loader').hide()
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "Dish_updated_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function clear_input_fields_Dish() {
        document.getElementById("DishName").value = "";
        document.getElementById("DishName_Arabic").value = "";
        $('#SubMenu_Dish').val('Sub Menu...').trigger('change')
    }
</script>