@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <div class="box box-default">

        <div class="box-body">

            <div class="row">
                <div class="col-md-12">
                    <div style="position: relative;">
                        <img src="/Images/profile_cover_photo.png" style="width: 100%;height:230px" alt="">

                        <div style="position:absolute;top:15px;left:30px">
                            <img id="profile_pic" src="" style="width: 100px;border-radius:50%;" alt="">
                            <h2 id="ProfileName" style="position: absolute;top:15px;left:115px;color:white">
                                </p>

                        </div>
                    </div>

                </div>

            </div>



        </div>


        <div class="box-body">
            <h3>Basic Info.</h3>
            <div class="row">
                <div class="form-group col-md-4">
                    <input type="hidden" id="user_id">
                    <label for="">Name</label>
                    <input id="name" style="border-top:none;border-left:none;border-right:none;" required type="text" name="name" class="form-control input-sm">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Email</label>
                    <input id="email" style="border-top:none;border-left:none;border-right:none;" required type="text" name="email" class="form-control input-sm">
                </div>
                <div class="form-group col-md-4">
                    <label for="">User Type</label>
                    <input id="UserType" style="border-top:none;border-left:none;border-right:none;" required type="text" name="UserType" class="form-control input-sm">
                </div>


            </div>

        </div>


        <div class="box-body">
            <h3>Password Reset</h3>
            <div class="row">
                <div style="display:none" id="password_div" class="form-group col-md-4">
                    <label for="">Password</label>
                    <input id="password" style="border-top:none;border-left:none;border-right:none;" required type="text" name="password" class="form-control input-sm">
                </div>
                <div style="display:none" id="confirm_password_div" class="form-group col-md-4">
                    <label for="">Cofirm Password</label>
                    <input id="confirm_password" style="border-top:none;border-left:none;border-right:none;" required type="text" name="confirm_password" class="form-control input-sm">
                </div>
                <div class="form-group col-md-2">
                    <buton onclick="Reset_Password()" id="Password_reset_btn" class="btn btn-success">Reset Password </buton>
                    <button onclick="Update_Password()" id="Password_update_btn" class="btn btn-success"> Update Password</button>
                </div>


            </div>

        </div>

    </div>

</div>

<script>
    document.getElementById('Password_update_btn').style.display = 'none';

    var LoggedIn_User = JSON.parse(sessionStorage.getItem('LoggedIn_User'))
    // console.log(LoggedIn_User)
    document.getElementById('user_id').value = LoggedIn_User.id;
    document.getElementById('ProfileName').innerText = LoggedIn_User.name;
    document.getElementById('name').value = LoggedIn_User.name;
    document.getElementById('email').value = LoggedIn_User.email;
    document.getElementById('UserType').value = LoggedIn_User.UserType;
    document.getElementById('profile_pic').src = LoggedIn_User.ProfilePic
    console.log(LoggedIn_User.name)

    function Reset_Password() {
        document.getElementById('password_div').style.display = 'block';
        document.getElementById('confirm_password_div').style.display = "block"
        document.getElementById('Password_reset_btn').style.display = 'none'
        document.getElementById('Password_update_btn').style.display = 'block';

    }

    function Update_Password() {
        var password = document.getElementById('password').value;
        var confirm_password = document.getElementById('confirm_password').value;
        if (password != confirm_password) {
            alert("Password is not matching")
            return false;
        }

        $.ajax({
            url: '/update_password',
            type: 'get',
            data: {
                password: password,
                user_id: document.getElementById('user_id').value
            },
            success: function(data) {
                console.log(data)
                if (data == 'Updated') {
                    document.getElementById('password_div').style.display = 'none';
                    document.getElementById('confirm_password_div').style.display = "none"
                    document.getElementById('Password_reset_btn').style.display = 'block'
                    document.getElementById('Password_update_btn').style.display = 'none';
                }
            }
        })
    }
</script>


@endsection