<script>
    $(".loader").hide()
    var Roles_assign_head = document.getElementsByName('Role_assign_head');
    var CheckBoxRoles_assign_head = document.getElementsByName('CheckBoxRole_assign_head');

    function SelectAll_Roles_or_Not_assign_head(value) {
        for (y = 0; y < Roles_assign_head.length; y++) {
            if (value.checked) {
                CheckBoxRoles_assign_head[y].checked = true;
            } else if (!value.checked) {
                CheckBoxRoles_assign_head[y].checked = false;
            }
        }
    }

    function update_assign_head() {
        var UserId_assign_head = document.getElementById('UserName_assign_head').value;

        if (UserId_assign_head == '') {
            alert("Please select UserName");
            return false;
        }

        var obj_assign_head = [];
        for (y = 0; y < Roles_assign_head.length; y++) {
            if (CheckBoxRoles_assign_head[y].checked) {
                obje_assign_head = {
                    Role: Roles_assign_head[y].value,
                };
                obj_assign_head.push(obje_assign_head);
            }
        }
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'assign_roles_Update_head',
            type: 'post',
            data: {
                Roles: obj_assign_head,
                UserId: UserId_assign_head,
                _token: token
            },
            beforeSend: function() {
                $(".loader").show();
            },
            success: function(obj) {
                console.log(obj)
                if (obj == "Enter") {
                    $(".loader").hide();
                    var output = `
                        <div class="alert alert-success">
                        <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                        Updated Successfuly
                        </div>    
                        `;
                    document.getElementById('show_insert_status_assign_head').innerHTML = output;
                    setTimeout(function() {
                        document.getElementById('show_insert_status_assign_head').innerHTML = ''
                    }, 5000);

                    for (y = 0; y < Roles.length; y++) {
                        CheckBoxRoles[y].checked = false;
                    }
                    $('#UserName_assign_head').val('').trigger('change');
                    document.getElementById('checkAll_Roles_or_Not_assign_head').checked = false;
                }
            }
        })

    }

    function getSelected_UserAssigned_Roles_assign_heads(UserId) {
        console.log(UserId)
        if (UserId != '') {
            $.ajax({
                url: '/AssignHead',
                type: 'get',
                data: {
                    UserId: UserId,
                },
                beforeSend: function() {
                    $(".loader").show();
                },
                success: function(obj) {
                    if (obj.length > 0) {
                        $(".loader").hide();
                        for (y = 0; y < Roles_assign_head.length; y++) {
                            CheckBoxRoles_assign_head[y].checked = false;
                            for (x = 0; x < obj.length; x++) {
                                if (Roles_assign_head[y].value == obj[x].AccountHead) {
                                    CheckBoxRoles_assign_head[y].checked = true;
                                    break;
                                }
                            }
                        }
                    } else {
                        for (y = 0; y < Roles_assign_head.length; y++) {
                            CheckBoxRoles_assign_head[y].checked = false;

                        }
                        alert('Record Not Found !');
                    }
                }
            })
        }
    }
</script>