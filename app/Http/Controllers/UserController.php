<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use App\Models\Role;
use App\Models\User;
use App\Models\assign_head_to_user;
use App\Models\RolePermissioins;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\InvoiceTrait;

class UserController extends Controller
{
    use InvoiceTrait;

    public function Profile_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            return view('admin/modules/Accounts/Profile');
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function UserType(Request $request)
    {
        $UserTypes = new UserType();

        return view('admin/modules/UserBook/UserType', ['UserTypes' => $UserTypes->get()]);
    }

    public function Usertype_1_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $UserType = new UserType();
            $array_result = [];
            $count =  count($UserType->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $UserType->get()[$a]->id,
                    'UserType' => $UserType->get()[$a]->UserType,
                ]);
            }
            return $array_result;
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function insertUsertype_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $UserType = new UserType();
            $UserType->UserType = $request->UserType;
            $insertUserType =  $UserType->save();

            if ($insertUserType) {
                return 'inserted';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function UsertypeEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $UserType = new UserType();
            return $UserType->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function  updateUsertype_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $UserType = new UserType();
            $updatedUserType = $UserType->where('id', $request->id)->update([
                'UserType' => $request->UserType,
            ]);

            if ($updatedUserType) {
                return 'updated';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function UsertypeDelete_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            $UserType = new UserType();
            $deleted =  $UserType
                ->where('id', $request->id)
                ->delete();
            if ($deleted) {
                return 'deleted';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function ShowUserTypes(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $UserType = new UserType();
            return $UserType->get();
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    //User Code starts from here
    public function User_method(Request $request)
    {
        $Users = new User();
        $UserTypes = new UserType();
        $Roles = new RolePermissioins();
        $Permissions = DB::table('permissions')->get();
        $account_heads = DB::table('account_heads')->distinct()->get();
        return view('admin/modules/UserBook/User', [
            'Users' => $Users->get(),
            'UserTypes' => $UserTypes->get(), 'Roles' => $Roles->distinct('Role')->get(), 'account_heads' => $account_heads,
            'Permissions' => $Permissions
        ]);
    }

    public function User_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            $User = new User();
            $array_result = [];
            $count =  count($User->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $User->get()[$a]->id,
                    'User' => $User->get()[$a]->User,
                ]);
            }
            return $array_result;
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function insertUser_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $User = new User();
            if ($request->hasfile('image')) {

                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $image = $request->file('image')->move('Images', $fileNameToStore);
            } else {
                $image = '';
            }
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = Hash::make($request->password);
            $User->UserType = $request->UserType;
            $User->ProfilePic = $image;
            $inserted = $User->save();
            if ($inserted) {
                return  'User Created';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function ShowUsers(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            $Users  = new User();
            return $Users->get();
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function UserEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $User = new User();
            $Roles = new RolePermissioins();
            return ['User' => $User->where('id', $request->id)->first(), 'Roles' => $Roles->get()];
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function  updateUser_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $User = new User();

            if ($request->hasfile('image')) {
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $image = $request->file('image')->move('Images', $fileNameToStore);
            } else {
                $image = $request->hidden_image;
            }
            if ($request->hidden_password != '') {
                $password = $request->hidden_password;
            } else {
                $password = Hash::make($request->password);
            }


            $updatedUser = $User->where('id', $request->User_Id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'Role' => $request->UserType,
                'ProfilePic' => $image,
                'password' => $password,
            ]);

            if ($updatedUser) {
                return 'User Updated';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function UserDelete_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $User = new User();
            $deleted =  $User
                ->where('id', $request->User_Id)
                ->delete();
            if ($deleted) {
                return 'Deleted';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function AssignRoles_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            if ($request->UserId) {
                return json_decode(DB::table('role_permissioins')->where('Role', $request->UserId)->first('Permissions')->Permissions);
            } else {
                $Roles = new RolePermissioins();
                $Users = DB::table('users')->distinct()->get();
                return view('admin/modules/UserBook/AssignRoles', [
                    'Users' => $Users, 'Roles' => $Roles->get()
                ]);
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }
    public function AssignRolesUpdate_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            if ($request->Permissions != '') {
                $Roles_Array  = [];

                foreach ($request->Permissions as $key => $value) {
                    array_push($Roles_Array, $request->Permissions[$key]['Permission']);
                }
                // return json_decode(json_encode($Roles_Array);

                DB::table('role_permissioins')->where('Role', $request->Role)->update([
                    'Permissions' => json_encode($Roles_Array)
                ]);
                $LoggedIn_User = DB::table('users')->where('id', $request->UserId)->first();
            }
            return [
                'status' => "Enter",
            ];
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }


    public function Role_method(Request $request)
    {
        $Role = new RolePermissioins();

        return view('admin/modules/Employee/Role', ['Roles' => $Role->get()]);
    }

    public function Role_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Role = new Role();
            $array_result = [];
            $count =  count($Role->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $Role->get()[$a]->id,
                    'Role' => $Role->get()[$a]->Role,
                ]);
            }
            return $array_result;
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function insertRole_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Role = new RolePermissioins();
            $Role->Role = $request->Role;
            $insertRole =  $Role->save();

            if ($insertRole) {
                return 'inserted';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function RoleEdit_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Role = new RolePermissioins();
            return $Role->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function  updateRole_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Role = new RolePermissioins();
            $updatedUserType = $Role->where('id', $request->id)->update([
                'Role' => $request->Role,
            ]);

            if ($updatedUserType) {
                return 'updated';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function RoleDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            $Role = new RolePermissioins();
            $deleted =  $Role
                ->where('id', $request->id)
                ->delete();
            if ($deleted) {
                return 'deleted';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function ShowRoles(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Role = new RolePermissioins();
            return $Role->get();
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function login_method(Request $request)
    {

        $hashed_password =  DB::table('users')->where('email', $request->email)->first('password');
        if ($hashed_password) {
            if (Hash::check($request->password, $hashed_password->password)) {
                $User = DB::table('users')->where('email', $request->email)->first();
                $credentions = $request->email . '-' . $request->password;
                $token = Hash::make($credentions);
                DB::table('token')->insert([
                    'token' => $token,
                    'time' => date("h:i:s"),
                    'expire' => 10 // 10 minuts
                ]);
                return [
                    'User' => $User,
                    'sessionToken' => $token,
                    'status' => 'exist',
                    'Permissions_of_selected_role' => json_decode(DB::table('role_permissioins')
                        ->where('Role', $User->Role)->first('Permissions')->Permissions)
                ];
            } else {
                return ['status' => "not exist"];
            }
        } else {
            return ['status' => 'not exist'];
        }
    }


    public function login_view_method()
    {

        $response = $this->checkloggedin(session('token'));
        if ($response == 'matched') {
            return redirect('/home');
        } else {
            return view('admin/modules/Login/loginform');
        }
    }

    public  function home_view_method()
    {
        $response = $this->checkloggedin(session('token'));
        if ($response == 'matched') {
            return view('admin/modules/dashboard/index2');
        } else {
            return redirect('login');
        }
    }

    public function setsessionToken_method(Request $request)
    {
        session(['token' => $request->token]);
        return session('token');
    }
    public  function logout_method(Request $request)
    {
        $status =  DB::table('token')->where('token', $request->token)->delete();
        session()->forget('token');
        return ['status' => $status];
    }


    public function AssignHead_method(Request $request)
    {
        if ($request->UserId) {
            $result = [];
            $abc =  (DB::table('assign_head_to_users')->where('User', $request->UserId)->distinct()->get('AccountHead'));
            $AH = DB::table('account_heads')->distinct('AccountHead')->get();
            for ($a = 0; $a < count($abc); $a++) {
                array_push($result, [
                    'AccountHead' => $AH->where('id', $abc[$a]->AccountHead)->pluck('AccountHead'),
                ]);
            }
            return $result;
        } else {

            $account_heads = DB::table('account_heads')->distinct()->get();

            $Users = DB::table('users')->distinct()->get();
            return view('admin/modules/BasicMenu/AssignHead', [
                'Users' => $Users, 'account_heads' => $account_heads,
            ]);
        }
    }

    public function AssignRolesUpdate_assign_head_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            if ($request->Roles != '') {
                $Roles_Array  = [];

                DB::table('assign_head_to_users')->where('User', $request->UserId)->delete();

                foreach ($request->Roles as $key => $value) {
                    // return $request->Roles[$key]['Role'];
                    // array_push($Roles_Array, $request->Roles[$key]['Role']);

                    DB::table('assign_head_to_users')->insert([
                        'User' => $request->UserId,
                        'AccountHead' => DB::table('account_heads')->where('AccountHead', $request->Roles[$key]['Role'])->first('id')->id
                    ]);
                }
            }
            return "Enter";
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function update_password(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $status =  DB::table('users')->where('id', $request->user_id)->update([
                'password' =>  Hash::make($request->password)
            ]);
            if ($status) {
                return "Updated";
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function Role_Permissions(Request $request)
    {
        $Roles = new RolePermissioins();
        $Permissions = DB::table('permissions')->get();
        return view('admin/modules/Employee/Role_Permissions', [
            'Roles' => $Roles->distinct('Role')->get(),
            'Permissions' => $Permissions
        ]);
    }

    // Permissions code starts from here
    public function Permission_method(Request $request)
    {
        $Role = DB::table('permissions')->get();
        return view('admin/modules/Employee/Permission', ['Roles' => $Role]);
    }


    public function insertPermission_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $insertRole =  DB::table('permissions')->insert([
                'Permission' => $request->Permission
            ]);

            if ($insertRole) {
                return 'inserted';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function PermissionEdit_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            return DB::table('permissions')->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function  updatePermission_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $updatedUserType = DB::table('permissions')->where('id', $request->id)->update([
                'Permission' => $request->Permission,
            ]);

            if ($updatedUserType) {
                return 'updated';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function PermissionDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $deleted =  DB::table('permissions')
                ->where('id', $request->id)
                ->delete();
            if ($deleted) {
                return 'deleted';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function ShowPermissions(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            return DB::table('permissions')->get();
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }
}
