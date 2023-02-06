<script>
    $(".loader").hide();

    var page_number = 1;
    variable_id_for_edit = "";
    var updated_ids_array = [];
    // data_table_pagination_SubMenu();

    function data_table_pagination_SubMenu() {
        $(function() {
            var table = $("#SubMenu_Table").DataTable({
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

    function ShowSubMenu() {
        $("#SubMenuModal").modal("show");
        $.ajax({
            url: "/SubMenu_1",
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
                                    <td>${el.SubMenu}</td>
                                    <td>${el.Menu}</td>
                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedSubMenuData('${el.id}')">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="DeleteSubMenu('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
                    });

                    document.getElementById("here_show_table_content_SubMenu").innerHTML =
                        "";

                    var table = `
                        <table id="SubMenu_Table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">SubMenu</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_SubMenu">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_SubMenu"
                    ).innerHTML = table;

                    data_table_pagination_SubMenu();

                    document.getElementById("abc_SubMenu").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }
                }
            }
        });
    }

    window.onload = event => {
        document.getElementById("SubMenu").focus();
        document.getElementById("SubMenu").select();
    };

    document.getElementById("SubMenuError").style.display = "none";

    function insertSubMenu() {
        var SubMenu = document.getElementById("SubMenu").value;
        var Menu = document.getElementById("Menu_SubMenu").value;
        var token = "{{csrf_token()}}";
        $.ajax({
            url: "/insertSubMenu",
            type: "post",
            data: {
                SubMenu: SubMenu,
                Menu: Menu,
                _token: token
            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == "inserted") {
                    $('.loader').hide()
                    clear_input_fields_SubMenu();

                    var output = `
                <div class="alert alert-success">
                <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                Saved Successfuly
                </div>    
                        `;
                    document.getElementById(
                        "SubMenu_updated_status"
                    ).innerHTML = output;
                }
            }
        });

        document.getElementById("SubMenu").focus();
        document.getElementById("SubMenu").select();
    }

    function getSelectedSubMenuData(id) {
        if (id != "") {
            // clear_input_fields();
            $("#SubMenuModal").modal("hide");
            $.ajax({
                url: "/SubMenuEdit",
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
                    document.getElementById("SubMenu_Id").value = data.SubMenu.Id;
                    document.getElementById("SubMenu").value = data.SubMenu.SubMenu;

                    var Menu = '';
                    data.Menu.forEach(el => {
                        Menu += `
<option value="${el.id}" ${el.id == data.SubMenu.MenuId ? 'selected' : ''}> ${el.Menu} </option>
`;
                    });

                    document.getElementById('Menu_SubMenu').innerHTML = Menu;

                    $("#SubMenuModal").modal("hide");
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function DeleteSubMenu(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            $.ajax({
                url: "/SubMenuDelete",
                type: "get",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $('.loader').show()
                },
                success: function(data) {
                    console.log(data);
                    if (data == "deleted") {
                        $('.loader').hide()
                        ShowSubMenu()
                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "SubMenu_deleted_status"
                        ).innerHTML = output;
                    }
                }
            });
        }
    }

    function UpdateSubMenu() {
        var formData = new FormData();
        formData.append("SubMenu", document.getElementById("SubMenu").value);
        formData.append("Menu", document.getElementById("Menu_SubMenu").value);
        formData.append("id", document.getElementById("SubMenu_Id").value);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/updateSubMenu",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                clear_input_fields_SubMenu();
                if (data == "updated") {
                    $('.loader').hide()
                    
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "SubMenu_updated_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function clear_input_fields_SubMenu() {
        document.getElementById("SubMenu").value = "";
        $('#Menu_SubMenu').val('').trigger('change');
    }
</script>