<br>
<br>

<div id="user_insert_status"></div>


<div class="row form-horizontal">

    <input type="hidden" id="hidden_password">
    <input type="hidden" id="hidden_image">
    <input type="hidden" id="User_Id">
    <div class="col-md-8">
        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
                <input type="text" required id="name" name="name" class="form-control input-sm" placeholder="Name">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Email</label>
            <div class="col-sm-8">
                <input type="email" required id="email" name="email" class="form-control input-sm" placeholder="Email">

            </div>
        </div>

        <div class="form-group">
            <label for="" class="col-sm-4 control-label">Password</label>
            <div class="col-sm-8">

                <input id="password" type="text" name="password" class="form-control input-sm" placeholder="Password">
            </div>

        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Role</label>
            <div class="col-sm-8">
                <select id="UserType" name="UserType" class="form-control input-sm select2" style="width: 100%;">
                    <option disabled selected value="">Select Role</option>
                    @foreach($Roles as $Permission)
                    <option>{{$Permission->Role}}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>
    <div class="col-md-4">

        <div style="display: flex; justify-content:center;margin-bottom:20px" class="row">
            <img id="image" src="adminassets/dist/img/avatar5.png" style="border-radius:50%;width: 150px;height:150px" alt="">

        </div>


        <div style="display: flex; justify-content:center" class="row">
            <div class="form-group">
                <label class="button" for="upload">
                    Choose file
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                    </svg>

                </label>
                <input id="upload" name="image" type="file">

            </div>

        </div>

    </div>


</div>


<div class="modal fade" id="AllUsersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" style="width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <b> Users </b>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>

            </div>
            <div class="modal-body">

                <div id="user_deleted_status"></div>

                <div class="box-body">
                    <div id="here_show_table_content_user">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">UserType</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="AllUsers">


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="box-header with-border">

    <div class="pull-right">
        <button id="UserInsertBtn" onclick="InsertUser()" class="btn btn-default">
            <i class="fa fa-fw fa-save"></i> Create
        </button>
        <button onclick="ShowUsers()" class="btn btn-default">
            <i class="fa fa-fw fa-eye"></i> Show
        </button>
        <button id="UserUpdateBtn" onclick="UpdateUser()" class="btn btn-default">
            <i class="fa fa-fw fa-refresh"></i> Update
        </button>

    </div>

</div>