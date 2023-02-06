@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Role</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="box box-default">

                    <div class="box-body">


                        <div id="Role_updated_status"></div>
                        <div class="row form-horizontal">
                            <input type="hidden" name="Role_Id" id="Role_Id">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Role</label>
                                    <div class="col-sm-8">
                                        <input id="Role" required type="text" class="form-control input-sm" placeholder="Role">
                                        <label id="RoleError"></label>

                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="modal fade" id="AllRolesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog mw-100 w-50" style="width: 80%;" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <b> Edit Role </b>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </h5>

                                    </div>
                                    <div class="modal-body">

                                        <div id="Role_deleted_status"></div>
                                        <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf -->

                                        <div class="box-body">
                                            <div id="here_show_table_content_role">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Role</th>
                                                            <th scope="col">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="AllRoles">

                                                    </tbody>
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



                        <div class="box-header ">
                            <div class="pull-right">
                                <button onclick="insertRole()" class="btn btn-default">
                                    <i class="fa fa-fw fa-save"></i> Save
                                </button>

                                <button onclick="ShowRoles()" class="btn btn-default">
                                    <i class="fa fa-fw fa-eye"></i> Show
                                </button>
                                <button onclick="UpdateRole()" class="btn btn-default">
                                    <i class="fa fa-fw fa-refresh"></i> Update
                                </button>


                            </div>
                        </div>




                    </div>
                </div>

            </div>
        </div>

    </section>

</div>


<script>
    $(".loader").hide();

    var page_number = 1;
    variable_id_for_edit = "";
    var updated_ids_array = [];
    // data_table_pagination_role();

    function data_table_pagination_role() {
        $(function() {
            var table = $("#Role_Table").DataTable({
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

    function ShowRoles() {
        $("#AllRolesModal").modal("show");
        $.ajax({
            url: "/ShowRoles",
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
                                    <td>${el.Role}</td>

                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedRoleData('${el.id}')">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="DeleteRole('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
                    });

                    document.getElementById("here_show_table_content_role").innerHTML =
                        "";

                    var table = `
                        <table id="Role_Table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_Role">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_role"
                    ).innerHTML = table;

                    data_table_pagination_role();

                    document.getElementById("abc_Role").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }
                }
            }
        });
    }

    window.onload = event => {
        document.getElementById("Role").focus();
        document.getElementById("Role").select();
    };

    document.getElementById("RoleError").style.display = "none";

    function insertRole() {
        var Role = document.getElementById("Role").value;
        var token = "{{csrf_token()}}";
        $.ajax({
            url: "/insertRole",
            type: "post",
            data: {
                Role: Role,
                _token: token
            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                // console.log(data)
                if (data == "inserted") {
                    $('.loader').hide()
                    clear_input_fields_role();

                    var output = `
                <div class="alert alert-success">
                <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                Saved Successfuly
                </div>    
                        `;
                    document.getElementById(
                        "Role_updated_status"
                    ).innerHTML = output;
                }
            }
        });

        document.getElementById("Role").focus();
        document.getElementById("Role").select();
    }

    function getSelectedRoleData(id) {
        if (id != "") {
            // clear_input_fields();
            $("#AllRolesModal").modal("hide");
            $.ajax({
                url: "/RoleEdit",
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
                    document.getElementById("Role_Id").value = data.id;
                    document.getElementById("Role").value = data.Role;

                    $("#AllRolesModal").modal("hide");
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function DeleteRole(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            $.ajax({
                url: "/RoleDelete",
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
                        ShowRoles()
                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "Role_deleted_status"
                        ).innerHTML = output;
                    }
                }
            });
        }
    }

    function UpdateRole() {
        var formData = new FormData();
        formData.append("Role", document.getElementById("Role").value);

        formData.append("id", document.getElementById("Role_Id").value);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/updateRole",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                clear_input_fields_role();
                if (data == "updated") {
                    $('.loader').hide()
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "Role_updated_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function clear_input_fields_role() {
        document.getElementById("Role").value = "";
    }
</script>
@endsection