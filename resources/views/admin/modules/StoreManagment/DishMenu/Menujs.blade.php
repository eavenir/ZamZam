<script>
    $(".loader").hide();

    var page_number = 1;
    variable_id_for_edit = "";
    var updated_ids_array = [];
    // data_table_pagination_Menu();

    function data_table_pagination_Menu() {
        $(function() {
            var table = $("#Menu_Table").DataTable({
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

    function ShowMenus() {
        $("#AllMenusModal").modal("show");
        $.ajax({
            url: "/Menu_1",
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
                                    <td>${el.Menu}</td>

                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedMenuData('${el.id}')">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="DeleteMenu('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
                    });

                    document.getElementById("here_show_table_content_Menu").innerHTML =
                        "";

                    var table = `
                        <table id="Menu_Table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_Menu">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_Menu"
                    ).innerHTML = table;

                    data_table_pagination_Menu();

                    document.getElementById("abc_Menu").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }
                }
            }
        });
    }

    window.onload = event => {
        document.getElementById("Menu").focus();
        document.getElementById("Menu").select();
    };

    document.getElementById("MenuError").style.display = "none";

    function insertMenu() {
        var Menu = document.getElementById("Menu").value;
        var token = "{{csrf_token()}}";
        $.ajax({
            url: "/insertMenu",
            type: "post",
            data: {
                Menu: Menu,
                _token: token
            },
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                // console.log(data)
                if (data == "inserted") {
                    $('.loader').hide()
                    clear_input_fields_Menu();

                    var output = `
                <div class="alert alert-success">
                <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                Saved Successfuly
                </div>    
                        `;
                    document.getElementById(
                        "Menu_updated_status"
                    ).innerHTML = output;
                }
            }
        });

        document.getElementById("Menu").focus();
        document.getElementById("Menu").select();
    }

    function getSelectedMenuData(id) {
        if (id != "") {
            // clear_input_fields();
            $("#AllMenusModal").modal("hide");
            $.ajax({
                url: "/MenuEdit",
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
                    document.getElementById("Menu_Id").value = data.id;
                    document.getElementById("Menu").value = data.Menu;

                    $("#AllMenusModal").modal("hide");
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function DeleteMenu(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            $.ajax({
                url: "/MenuDelete",
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
                        ShowMenus()
                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "Menu_deleted_status"
                        ).innerHTML = output;
                    }
                }
            });
        }
    }

    function UpdateMenu() {
        var formData = new FormData();
        formData.append("Menu", document.getElementById("Menu").value);

        formData.append("id", document.getElementById("Menu_Id").value);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/updateMenu",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                clear_input_fields_Menu();
                if (data == "updated") {
                    $('.loader').hide()
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "Menu_updated_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function clear_input_fields_Menu() {
        document.getElementById("Menu").value = "";
    }
</script>