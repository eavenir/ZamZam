@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Role Permissions</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="box box-default">

                    <div class="box-body">

                        <br>
                        <br>
                        <div id="show_insert_status_assign_roles"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select Role</label>
                                    <select style="width:100%" required class="form-control select2" required name="Role" id="Role" onchange="getSelected_UserAssigned_Roles(this.value)">
                                        <option selected value="" disabled>Select Role...</option>
                                        @foreach($Roles as $User)
                                        <option>{{$User->Role}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <input type="checkbox" onchange="SelectAll_Roles_or_Not(this)" id="checkAll_Roles_or_Not"> <label>Select All Permissions</label>
                            </div>

                        </div>
                        <div class="row">
                            @foreach($Permissions as $Permission)
                            <div class="col-md-4" style="display: flex;">
                                <div class="form-group">
                                    <input type="checkbox" name="CheckBoxPermissions">
                                </div>
                                <div style="width: 100%;" class="form-group">
                                    <input disabled value="{{$Permission->Permission}}" style="width:100%" type='text' name='Permissions'>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <button onclick="update();" class="btn btn-default pull-right"><i class="fa fa-fw fa-refresh"></i> Update</button>
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
    var Roles = document.getElementsByName("Permissions");
    var CheckBoxRoles = document.getElementsByName("CheckBoxPermissions");

    function SelectAll_Roles_or_Not(value) {
        for (y = 0; y < Roles.length; y++) {
            console.log(Roles[y].value)
            if (value.checked) {
                CheckBoxRoles[y].checked = true;
            } else if (!value.checked) {
                CheckBoxRoles[y].checked = false;
            }
        }
    }

    function update() {
        var Role = document.getElementById("Role").value;

        if (Role == "") {
            alert("Please select Role");
            return false;
        }

        var obj = [];

        for (y = 0; y < Roles.length; y++) {
            if (CheckBoxRoles[y].checked) {
                obje = {
                    Permission: Roles[y].value
                };
                obj.push(obje);
            }
        }
        // console.log(obj)
        var token = "{{csrf_token()}}";
        var LoggedIn_User = (JSON.parse(sessionStorage.getItem('LoggedIn_User')));
        $.ajax({
            url: "/assign_roles_Update",
            type: "post",
            data: {
                Permissions: obj,
                Role: Role,
                UserId: LoggedIn_User.id,
                _token: token
            },
            beforeSend: function() {
                $(".loader").show();
            },
            success: function(obj) {
                console.log(obj)
                if (obj.status == "Enter") {
                    $('.loader').hide()
                    sessionStorage.setItem('LoggedIn_User', JSON.stringify(obj.LoggedIn_User));

                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                    `;
                    document.getElementById(
                        "show_insert_status_assign_roles"
                    ).innerHTML = output;
                    $(".loader").hide();
                    setTimeout(function() {
                        document.getElementById("show_insert_status_assign_roles").innerHTML =
                            "";
                    }, 5000);

                    for (y = 0; y < Roles.length; y++) {
                        CheckBoxRoles[y].checked = false;
                    }
                    $("#Role")
                        .val("")
                        .trigger("change");
                    document.getElementById(
                        "checkAll_Roles_or_Not"
                    ).checked = false;
                }
            }
        });
    }

    function getSelected_UserAssigned_Roles(Role) {

        if (Role != "") {
            $.ajax({
                url: "/assign_roles",
                type: "get",
                data: {
                    UserId: Role
                },
                beforeSend: function() {
                    $(".loader").show();
                },
                success: function(obj) {
                    console.log(obj)
                    if (obj.length != 0) {
                        for (y = 0; y < Roles.length; y++) {
                            CheckBoxRoles[y].checked = false;
                            for (x = 0; x < obj.length; x++) {

                                if (Roles[y].value == obj[x]) {
                                    CheckBoxRoles[y].checked = true;
                                    break;
                                }
                            }
                        }
                        console.log("fff")
                        $(".loader").hide();
                    } else {
                        for (y = 0; y < Roles.length; y++) {
                            CheckBoxRoles[y].checked = false;

                        }
                        alert("Record Not Found !");
                        $(".loader").hide();
                    }
                }
            });
        }
    }
</script>

@endsection