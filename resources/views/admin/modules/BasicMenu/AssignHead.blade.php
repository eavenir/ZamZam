<br><br>
<div id="show_insert_status_assign_head"></div>
<div style="overflow-x: scroll;">
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Select User</label>
                    <select required class="form-control select2" required name="UserName_assign_head" id="UserName_assign_head" onchange="getSelected_UserAssigned_Roles_assign_heads(this.value)">
                        <option selected value="" disabled>Select User...</option>
                        @foreach($Users as $User)
                        <option value="{{$User->id}}">{{$User->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <input type="checkbox" onchange="SelectAll_Roles_or_Not_assign_head(this)" id="checkAll_Roles_or_Not_assign_head"> <label>Select All Heads</label>
            </div>

        </div>
        <div class="row">
            @foreach($account_heads as $Role)
            <div class="col-md-4" style="display: flex;">
                <div class="form-group">
                    <input type="checkbox" name="CheckBoxRole_assign_head">
                </div>
                <div style="width: 100%;" class="form-group">
                    <input disabled value="{{$Role->AccountHead}}" style="width:100%" type='text' name='Role_assign_head'>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button onclick="update_assign_head();" class="btn btn-default pull-right"><i class="fa fa-fw fa-refresh"></i> Update</button>
        </div>

    </div>


</div>