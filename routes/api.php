<?php


use Illuminate\Support\Facades\Route;


Route::post('/login', [App\Http\Controllers\UserController::class, 'login_method']);


// User related code starts from here
Route::get('UserType', [App\Http\Controllers\UserController::class, 'UserType']);
// User Type Code starts from here
Route::get('Usertype', [App\Http\Controllers\UserController::class, 'Usertype_method']);
Route::get('Usertype_1', [App\Http\Controllers\UserController::class, 'Usertype_1_method']);
Route::post('insertUserType', [App\Http\Controllers\UserController::class, 'insertUsertype_method']);
Route::get('UsertypeEdit', [App\Http\Controllers\UserController::class, 'UsertypeEdit_method']);
Route::post('updateUserType', [App\Http\Controllers\UserController::class, 'updateUsertype_method']);
Route::get('UsertypeDelete', [App\Http\Controllers\UserController::class, 'UsertypeDelete_method']);
Route::get('/ShowUserTypes',[App\Http\Controllers\UserController::class,'ShowUserTypes']);


// User Type Code starts from here
Route::get('User', [App\Http\Controllers\UserController::class, 'User_method']);
Route::get('User_1', [App\Http\Controllers\UserController::class, 'User_1_method']);
Route::post('InsertUser', [App\Http\Controllers\UserController::class, 'insertUser_method']);
Route::get('UserEdit', [App\Http\Controllers\UserController::class, 'UserEdit_method']);
Route::post('UpdateUser', [App\Http\Controllers\UserController::class, 'updateUser_method']);
Route::get('UserDelete', [App\Http\Controllers\UserController::class, 'UserDelete_method']);
Route::get('ShowUsers', [App\Http\Controllers\UserController::class, 'ShowUsers']);

Route::get('assign_roles', [App\Http\Controllers\UserController::class, 'AssignRoles_method']);
Route::post('assign_roles_Update', [App\Http\Controllers\UserController::class, 'AssignRolesUpdate_method']);


// Attendance Code starts from here
Route::get('Attendance', [App\Http\Controllers\EmployeeController::class, 'Attendance_method']);
Route::get('Attendance_1', [App\Http\Controllers\EmployeeController::class, 'Attendance_1_method']);
Route::post('insertAttendance', [App\Http\Controllers\EmployeeController::class, 'insertAttendance_method']);
Route::get('AttendanceEdit', [App\Http\Controllers\EmployeeController::class, 'AttendanceEdit_method']);
Route::post('updateAttendance', [App\Http\Controllers\EmployeeController::class, 'updateAttendance_method']);
Route::get('AttendanceDelete', [App\Http\Controllers\EmployeeController::class, 'AttendanceDelete_method']);

// Cost Center Name Code starts from here
Route::get('CostCenterName', [App\Http\Controllers\CostCenterNameController::class, 'CostCenterName_method']);
Route::get('CostCenterName_1', [App\Http\Controllers\CostCenterNameController::class, 'CostCenterName_1_method']);
Route::post('insertCostCenterName', [App\Http\Controllers\CostCenterNameController::class, 'insertCostCenterName_method']);
Route::get('CostCenterNameEdit', [App\Http\Controllers\CostCenterNameController::class, 'CostCenterNameEdit_method']);
Route::post('updateCostCenterName', [App\Http\Controllers\CostCenterNameController::class, 'updateCostCenterName_method']);
Route::get('CostCenterNameDelete', [App\Http\Controllers\CostCenterNameController::class, 'CostCenterNameDelete_method']);

// AccountHead Code starts from here
Route::get('AccountHead', [App\Http\Controllers\AccountHeadController::class, 'AccountHead_method']);
Route::get('AccountHead_1', [App\Http\Controllers\AccountHeadController::class, 'AccountHead_1_method']);
Route::post('insertAccountHead', [App\Http\Controllers\AccountHeadController::class, 'insertAccountHead_method']);
Route::get('AccountHeadEdit', [App\Http\Controllers\AccountHeadController::class, 'AccountHeadEdit_method']);
Route::post('updateAccountHead', [App\Http\Controllers\AccountHeadController::class, 'updateAccountHead_method']);
Route::get('AccountHeadDelete', [App\Http\Controllers\AccountHeadController::class, 'AccountHeadDelete_method']);

// Role Code starts from here
Route::get('Role', [App\Http\Controllers\UserController::class, 'Role_method']);
Route::get('Role_1', [App\Http\Controllers\UserController::class, 'Role_1_method']);
Route::post('insertRole', [App\Http\Controllers\UserController::class, 'insertRole_method']);
Route::get('RoleEdit', [App\Http\Controllers\UserController::class, 'RoleEdit_method']);
Route::post('updateRole', [App\Http\Controllers\UserController::class, 'updateRole_method']);
Route::get('RoleDelete', [App\Http\Controllers\UserController::class, 'RoleDelete_method']);
Route::get('ShowRoles',[App\Http\Controllers\UserController::class,'ShowRoles']);

// Buyers and suppliers Code starts from here
Route::get('Buyers_Suppliers', [App\Http\Controllers\BuyersSuppliersController::class, 'Buyers_Suppliers_method']);
Route::get('Buyers_Suppliers_1', [App\Http\Controllers\BuyersSuppliersController::class, 'Buyers_Suppliers_1_method']);
Route::post('insertBuyers_Suppliers', [App\Http\Controllers\BuyersSuppliersController::class, 'insertBuyers_Suppliers_method']);
Route::get('Buyers_SuppliersEdit', [App\Http\Controllers\BuyersSuppliersController::class, 'Buyers_SuppliersEdit_method']);
Route::post('updateBuyers_Suppliers', [App\Http\Controllers\BuyersSuppliersController::class, 'updateBuyers_Suppliers_method']);
Route::get('Buyers_SuppliersDelete', [App\Http\Controllers\BuyersSuppliersController::class, 'Buyers_SuppliersDelete_method']);

// Account Code starts from here
Route::get('Account', [App\Http\Controllers\AccountController::class, 'Account_method']);
Route::get('Account_1', [App\Http\Controllers\AccountController::class, 'Account_1_method']);
Route::post('insertAccount', [App\Http\Controllers\AccountController::class, 'insertAccount_method']);
Route::get('AccountEdit', [App\Http\Controllers\AccountController::class, 'AccountEdit_method']);
Route::post('updateAccount', [App\Http\Controllers\AccountController::class, 'updateAccount_method']);
Route::get('AccountDelete', [App\Http\Controllers\AccountController::class, 'AccountDelete_method']);

// Employee Category Code starts from here
Route::get('EmployeeCategory', [App\Http\Controllers\EmployeeCategoryController::class, 'EmployeeCategory_method']);
Route::get('EmployeeCategory_1', [App\Http\Controllers\EmployeeCategoryController::class, 'EmployeeCategory_1_method']);
Route::post('insertEmployeeCategory', [App\Http\Controllers\EmployeeCategoryController::class, 'insertEmployeeCategory_method']);
Route::get('EmployeeCategoryEdit', [App\Http\Controllers\EmployeeCategoryController::class, 'EmployeeCategoryEdit_method']);
Route::post('updateEmployeeCategory', [App\Http\Controllers\EmployeeCategoryController::class, 'updateEmployeeCategory_method']);
Route::get('EmployeeCategoryDelete', [App\Http\Controllers\EmployeeCategoryController::class, 'EmployeeCategoryDelete_method']);

// Employee Code starts from here
Route::get('Employee', [App\Http\Controllers\EmployeeController::class, 'Employee_method']);
Route::get('Employee_1', [App\Http\Controllers\EmployeeController::class, 'Employee_1_method']);
Route::post('insertEmployee', [App\Http\Controllers\EmployeeController::class, 'insertEmployee_method']);
Route::get('EmployeeEdit', [App\Http\Controllers\EmployeeController::class, 'EmployeeEdit_method']);
Route::post('updateEmployee', [App\Http\Controllers\EmployeeController::class, 'updateEmployee_method']);
Route::get('EmployeeDelete', [App\Http\Controllers\EmployeeController::class, 'EmployeeDelete_method']);
Route::get('/ShowEmployees', [App\Http\Controllers\EmployeeController::class, 'ShowEmployees']);

Route::get('/abc',function(){
return "abc returned value";
});