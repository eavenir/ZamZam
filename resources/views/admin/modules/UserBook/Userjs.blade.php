<script>
    $(".loader").hide();

    document.getElementById('UserUpdateBtn').disabled = true;

    function data_table_pagination_user() {
        $(function() {
            var table = $("#User_Table").DataTable({
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

    window.onload = event => {
        document.getElementById("name").focus();
        document.getElementById("name").select();
    };

    function confirmToDelete_user(value) {
        var status = confirm("Want to delete ?");
        if (status) {
            location.href = value;
        }
    }

    let input = document.getElementById("upload");
    let img = document.getElementById("image");
    var _URL = window.URL || window.webkitURL;
    input.addEventListener("change", () => {
        let file = input.files[0];
        var ImageName = file.name;

        var ImageExtension = ImageName.split(".");

        if (ImageExtension[1] == "jpg" || ImageExtension[1] == "png") {
            if (file) {
                let reader = new FileReader();
                reader.addEventListener("load", () => (img.src = reader.result));
                reader.readAsDataURL(file);
            } else {
                img.src = "images/blank.png";
            }
        } else {
            alert("Please select image of jpg or png type");
        }
    });

    let input2 = document.getElementById("modal_upload");
    let img2 = document.getElementById("modal_image");
    input2.addEventListener("change", () => {
        let file = input2.files[0];

        if (file) {
            let reader = new FileReader();
            reader.addEventListener("load", () => (img2.src = reader.result));
            reader.readAsDataURL(file);
        } else {
            img2.src = "images/blank.png";
        }
    });

    function ShowUsers() {
        $.ajax({
            url: "/ShowUsers",
            type: "get",
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                if (data) {
                    $('.loader').hide()
                    var tr = "";
                    data.forEach(el => {
                        tr += `
                <tr>
                
                <td>${el.name}</td>
                <td>${el.email}</td>
                <td>${el.Role}</td>
                <td> <img style="width:100px" src='/${el.ProfilePic}'> </td>
    
                <td>
                    <span style="cursor: pointer;" id="id_${el.id}" onclick="getSelectedUserData('${el.id}')">
                        <i class="fa fa-fw fa-edit"></i> Edit
                    </span>
    
                    <span style="cursor: pointer;" onclick="DeleteUser('${el.id}')">
                        <i class="fa fa-fw fa-eraser"></i> Delete
                    </span>
    
                </td>
            </tr>
                `;
                    });
                    document.getElementById("here_show_table_content_user").innerHTML =
                        "";

                    var table = `
                    <table id="User_Table" class="table">
                        <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>

                    </tr>
                        </thead>
                        <tbody id="abc_user">


                        </tbody>
                    </table>
`;

                    document.getElementById(
                        "here_show_table_content_user"
                    ).innerHTML = table;

                    data_table_pagination_user();

                    document.getElementById("abc_user").innerHTML = tr;

                    $("#AllUsersModal").modal("show");
                }
            }
        });
    }

    function getSelectedUserData(id) {
        document.getElementById('UserInsertBtn').disabled = true;
        document.getElementById('UserUpdateBtn').disabled = false;
        if (id != "") {
            clear_input_fields();
            $("#AllUsersModal").modal("hide");
            $.ajax({
                url: "/UserEdit",
                type: "get",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $(".loader").show();
                },

                success: function(data) {
                    console.log(data);
                    if (data) {
                        $('.loader').hide()
                        document.getElementById("User_Id").value = data.User.id;
                        document.getElementById("name").value = data.User.name;
                        document.getElementById("email").value = data.User.email;
                        document.getElementById("hidden_password").value =
                            data.User.password;
                        document.getElementById("hidden_image").value =
                            data.User.ProfilePic;

                        var Roles = "";
                        data.Roles.forEach(el => {
                            Roles += `
                    <option ${
                        data.User.Role == el.Role ? "selected" : ""
                    } >${el.Role}</option>
                    `;
                        });
                        document.getElementById("UserType").innerHTML = Roles;

                        document.getElementById("image").src =
                            "http://localhost:8000/" + data.User.ProfilePic;

                        $("#AllUsersModal").modal("hide");
                    }
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }
    }

    function DeleteUser(id) {
        var status = confirm("Want to delete ?");
        if (status) {
            $.ajax({
                url: "/UserDelete",
                type: "get",
                data: {
                    User_Id: id
                },
                beforeSend : function(){
                    $('.loader').show()
                },
                success: function(data) {
                    // console.log(data)
                    if (data == "Deleted") {
                        $('.loader').hide()
                        var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Deleted Successfuly
                    </div>    
                            `;
                        document.getElementById(
                            "user_deleted_status"
                        ).innerHTML = output;
                    }
                }
            });
        }
    }

    function UpdateUser() {
        var formData = new FormData();
        formData.append("name", document.getElementById("name").value);
        formData.append("email", document.getElementById("email").value);
        formData.append("password", document.getElementById("password").value);
        formData.append("UserType", document.getElementById("UserType").value);
        formData.append(
            "hidden_password",
            document.getElementById("hidden_password").value
        );
        formData.append(
            "hidden_image",
            document.getElementById("hidden_image").value
        );

        formData.append("image", document.getElementById("upload").files[0]);
        formData.append("User_Id", document.getElementById("User_Id").value);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/UpdateUser",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                clear_input_fields();
                if (data == "User Updated") {
                    $('.loader').hide()
                    document.getElementById('UserInsertBtn').disabled = false;
                    document.getElementById('UserUpdateBtn').disabled = true;
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Updated Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "user_insert_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function InsertUser() {
        var formData = new FormData();
        formData.append("name", document.getElementById("name").value);
        formData.append("email", document.getElementById("email").value);
        formData.append("password", document.getElementById("password").value);
        formData.append("UserType", document.getElementById("UserType").value);

        formData.append("image", document.getElementById("upload").files[0]);

        formData.append("_token", "{{csrf_token()}}");

        $.ajax({
            url: "/InsertUser",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend : function(){
                $('.loader').show()
            },
            success: function(data) {
                console.log(data);
                if (data == "User Created") {
                    $('.loader').hide()
                    clear_input_fields();
                    var output = `
                    <div class="alert alert-success">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Saved Successfuly
                    </div>    
                            `;
                    document.getElementById(
                        "user_insert_status"
                    ).innerHTML = output;
                } else {
                    var output = `
                    <div class="alert alert-danger">
                    <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                    Something went wrong !
                    </div>    
                            `;
                    document.getElementById(
                        "user_insert_status"
                    ).innerHTML = output;
                }
            }
        });
    }

    function clear_input_fields() {
        document.getElementById("name").value = "";
        document.getElementById("email").value = "";
        document.getElementById("password").value = "";
        $("#UserType")
            .val("")
            .trigger("change");
        document.getElementById("User_Id").value = "";
        document.getElementById("hidden_image").value = "";
        document.getElementById("hidden_password").value = "";
        document.getElementById("image").src = "adminassets/dist/img/avatar5.png";
    }
</script>