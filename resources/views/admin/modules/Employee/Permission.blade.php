@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Permission</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="box box-default">

                    <div class="box-body">


                        <div id="Permission_updated_status"></div>
                        <div class="row form-horizontal">
                            <input type="hidden" name="Permission_Id" id="Permission_Id">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="col-sm-4 control-label">Permission</label>
                                    <div class="col-sm-8">
                                        <input id="Permission" required type="text" class="form-control input-sm" placeholder="Permission">
                                        <label id="PermissionError"></label>

                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="modal fade" id="AllPermissionsModal" tabindex="-1" Permission="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog mw-100 w-50" style="width: 80%;" Permission="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <b> Edit Permission </b>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </h5>

                                    </div>
                                    <div class="modal-body">

                                        <div id="Permission_deleted_status"></div>
                                        <!-- <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf -->

                                        <div class="box-body">
                                            <div id="here_show_table_content_Permission">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Permission</th>
                                                            <th scope="col">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="AllPermissions">

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
                                <button onclick="insertPermission()" class="btn btn-default">
                                    <i class="fa fa-fw fa-save"></i> Save
                                </button>

                                <button onclick="ShowPermissions()" class="btn btn-default">
                                    <i class="fa fa-fw fa-eye"></i> Show
                                </button>
                                <button onclick="UpdatePermission()" class="btn btn-default">
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
    // data_table_pagination_Permission();

    function data_table_pagination_Permission() {
        $(function() {
            var table = $("#Permission_Table").DataTable({
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

    function ShowPermissions() {
        $("#AllPermissionsModal").modal("show");
        $.ajax({
            url: "/ShowPermissions",
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
                                    <td>${el.Permission}</td>

                                    <td>
                                        <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedPermissionData('${el.id}')">
                                            <i class="fa fa-fw fa-edit"></i> Edit
                                        </span>

                                        <span style="cursor: pointer;" onclick="DeletePermission('${el.id}')">
                                            <i class="fa fa-fw fa-eraser"></i> Delete
                                        </span>

                                    </td>
                                </tr>
        
        `;
                    });

                    document.getElementById("here_show_table_content_Permission").innerHTML =
                        "";

                    var table = `
                        <table id="Permission_Table" class="table">
                            <thead>
                            <tr>
                                    <th scope="col">Permission</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="abc_Permission">


                            </tbody>
                        </table>
`;

                    document.getElementById(
                        "here_show_table_content_Permission"
                    ).innerHTML = table;

                    data_table_pagination_Permission();

                    document.getElementById("abc_Permission").innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style =
                            "color:red;cursor:pointer";
                    }
                }
            }
        });
    }

    window.onload = event => {
        document.getElementById("Permission").focus();
        document.getElementById("Permission").select();
    };

    document.getElementById("PermissionError").style.display = "none";

    function insertPermission() {
        var Permission = document.getElementById("Permission").value;
        var token = "{{csrf_token()}}";
        $.ajax({
            url: "/insertPermission",
            type: "post",
            data: {
                Permission: Permission,
                _token: token
            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                // console.log(data)
                if (data == "inserted") {
                    $('.loader').hide()
                    clear_input_fields_Permission();

                    var output = `
                <div class="alert alert-success">
                <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                Saved Successfuly
                </div>    
                        `;
                    document.getElementById(
                        "Permission_updated_status"
                    ).innerHTML = output;
                }
            }
        });

        document.getElementById("Permission").focus();
        document.getElementById("Permission").select();
    }

    function getSelectedPermissionData(id) {
        if (id != "") {
            // clear_input_fields();
            $("#AllPermissionsModal").modal("hide");
            $.ajax({
                url: "/PermissionEdit",
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
                    document.getElementById("Permission_Id").value = data.id;
                    document.getElementById("Permission").value = data.Permission;

                    $("#AllPermissionsModal").modal("hide");
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function DeletePermission(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            $.ajax({
                url: "/PermissionDelete",
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
                        ShowPermissions()
                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "Permission_deleted_status"
                        ).innerHTML = output;
                    }
                }
            });
        }
    }

    function UpdatePermission() {
        var formData = new FormData();
        formData.append("Permission", document.getElementById("Permission").value);

        formData.append("id", document.getElementById("Permission_Id").value);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/updatePermission",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                clear_input_fields_Permission();
                if (data == "updated") {
                    $('.loader').hide()
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "Permission_updated_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function clear_input_fields_Permission() {
        document.getElementById("Permission").value = "";
    }
</script>
@endsection