<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/getHeads', [App\Http\Controllers\AccountController::class, 'getHeads']);

Route::post('/login_user', [App\Http\Controllers\UserController::class, 'login_method']);
Route::get('/login', [App\Http\Controllers\UserController::class, 'login_view_method']);

Route::get('/setsessionToken', [App\Http\Controllers\UserController::class, 'setsessionToken_method']);

Route::get('/home', [App\Http\Controllers\UserController::class, 'home_view_method']);

Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout_method']);
Route::get('/Profile', [App\Http\Controllers\UserController::class, 'Profile_method']);
Route::get('update_password', [App\Http\Controllers\UserController::class, 'update_password']);

// User Type Code starts from here
Route::get('User', [App\Http\Controllers\UserController::class, 'User_method']);

// Cost Center Name Code starts from here
// api duplicate route
Route::get('CostCenter', [App\Http\Controllers\CostCenterNameController::class, 'CostCenter_method']);
Route::get('CostCenterName_1', [App\Http\Controllers\CostCenterNameController::class, 'CostCenterName_1_method']);
Route::post('insertCostCenterName', [App\Http\Controllers\CostCenterNameController::class, 'insertCostCenterName_method']);
Route::get('CostCenterNameEdit', [App\Http\Controllers\CostCenterNameController::class, 'CostCenterNameEdit_method']);
Route::post('updateCostCenterName', [App\Http\Controllers\CostCenterNameController::class, 'updateCostCenterName_method']);
Route::get('CostCenterNameDelete', [App\Http\Controllers\CostCenterNameController::class, 'CostCenterNameDelete_method']);

// AccountHead Code starts from here
Route::get('AccountHead', [App\Http\Controllers\AccountHeadController::class, 'AccountHead_method']);



// Account Code starts from here
Route::get('Account', [App\Http\Controllers\AccountController::class, 'Account_method']);

// Employee Code starts from here
// api duplicate route
Route::get('Employee', [App\Http\Controllers\EmployeeController::class, 'Employee_method']);
Route::get('/ShowEmployees', [App\Http\Controllers\EmployeeController::class, 'ShowEmployees']);
Route::get('Employee_1', [App\Http\Controllers\EmployeeController::class, 'Employee_1_method']);
Route::post('insertEmployee', [App\Http\Controllers\EmployeeController::class, 'insertEmployee_method']);
Route::get('EmployeeEdit', [App\Http\Controllers\EmployeeController::class, 'EmployeeEdit_method']);
Route::post('updateEmployee', [App\Http\Controllers\EmployeeController::class, 'updateEmployee_method']);
Route::get('EmployeeDelete', [App\Http\Controllers\EmployeeController::class, 'EmployeeDelete_method']);


// Attendance Code starts from here
// api duplicate route
Route::get('Attendance_1', [App\Http\Controllers\EmployeeController::class, 'Attendance_1_method']);
Route::post('insertAttendance', [App\Http\Controllers\EmployeeController::class, 'insertAttendance_method']);
Route::get('AttendanceEdit', [App\Http\Controllers\EmployeeController::class, 'AttendanceEdit_method']);
Route::post('updateAttendance', [App\Http\Controllers\EmployeeController::class, 'updateAttendance_method']);
Route::get('AttendanceDelete', [App\Http\Controllers\EmployeeController::class, 'AttendanceDelete_method']);

// Employee Category Code starts from here
// api duplicate route
Route::get('EmployeeCategory_1', [App\Http\Controllers\EmployeeCategoryController::class, 'EmployeeCategory_1_method']);
Route::post('insertEmployeeCategory', [App\Http\Controllers\EmployeeCategoryController::class, 'insertEmployeeCategory_method']);
Route::get('EmployeeCategoryEdit', [App\Http\Controllers\EmployeeCategoryController::class, 'EmployeeCategoryEdit_method']);
Route::post('updateEmployeeCategory', [App\Http\Controllers\EmployeeCategoryController::class, 'updateEmployeeCategory_method']);
Route::get('EmployeeCategoryDelete', [App\Http\Controllers\EmployeeCategoryController::class, 'EmployeeCategoryDelete_method']);

// AccountHead Code starts from here
// api duplicate route
Route::get('AccountHead', [App\Http\Controllers\AccountHeadController::class, 'AccountHead_method']);
Route::get('AccountHead_1', [App\Http\Controllers\AccountHeadController::class, 'AccountHead_1_method']);
Route::post('insertAccountHead', [App\Http\Controllers\AccountHeadController::class, 'insertAccountHead_method']);
Route::get('AccountHeadEdit', [App\Http\Controllers\AccountHeadController::class, 'AccountHeadEdit_method']);
Route::post('updateAccountHead', [App\Http\Controllers\AccountHeadController::class, 'updateAccountHead_method']);
Route::get('AccountHeadDelete', [App\Http\Controllers\AccountHeadController::class, 'AccountHeadDelete_method']);

// AssignHead Name Code starts from here
Route::get('AssignHead', [App\Http\Controllers\UserController::class, 'AssignHead_method']);
Route::post('assign_roles_Update_head', [App\Http\Controllers\UserController::class, 'AssignRolesUpdate_assign_head_method']);

Route::get('assign_roles', [App\Http\Controllers\UserController::class, 'AssignRoles_method']);
Route::post('assign_roles_Update', [App\Http\Controllers\UserController::class, 'AssignRolesUpdate_method']);

// Role Code starts from here
// api duplicate route
Route::get('Role', [App\Http\Controllers\UserController::class, 'Role_method']);
Route::get('Role_1', [App\Http\Controllers\UserController::class, 'Role_1_method']);
Route::post('insertRole', [App\Http\Controllers\UserController::class, 'insertRole_method']);
Route::get('RoleEdit', [App\Http\Controllers\UserController::class, 'RoleEdit_method']);
Route::post('updateRole', [App\Http\Controllers\UserController::class, 'updateRole_method']);
Route::get('RoleDelete', [App\Http\Controllers\UserController::class, 'RoleDelete_method']);
Route::get('ShowRoles', [App\Http\Controllers\UserController::class, 'ShowRoles']);

// Permission Code starts from here
Route::get('Permission', [App\Http\Controllers\UserController::class, 'Permission_method']);
Route::get('Permission_1', [App\Http\Controllers\UserController::class, 'Permission_1_method']);
Route::post('insertPermission', [App\Http\Controllers\UserController::class, 'insertPermission_method']);
Route::get('PermissionEdit', [App\Http\Controllers\UserController::class, 'PermissionEdit_method']);
Route::post('updatePermission', [App\Http\Controllers\UserController::class, 'updatePermission_method']);
Route::get('PermissionDelete', [App\Http\Controllers\UserController::class, 'PermissionDelete_method']);
Route::get('ShowPermissions', [App\Http\Controllers\UserController::class, 'ShowPermissions']);

// Role Code starts from here

Route::get('Role_Permissions', [App\Http\Controllers\UserController::class, 'Role_Permissions']);


// Account Code starts from here
// api duplicate route
Route::get('Account', [App\Http\Controllers\AccountController::class, 'Account_method']);
Route::get('Account_1', [App\Http\Controllers\AccountController::class, 'Account_1_method']);
Route::post('insertAccount', [App\Http\Controllers\AccountController::class, 'insertAccount_method']);
Route::get('AccountEdit', [App\Http\Controllers\AccountController::class, 'AccountEdit_method']);
Route::post('updateAccount', [App\Http\Controllers\AccountController::class, 'updateAccount_method']);
Route::get('AccountDelete', [App\Http\Controllers\AccountController::class, 'AccountDelete_method']);

// Buyers and suppliers Code starts from here
// api duplicate route
Route::get('Buyers', [App\Http\Controllers\BuyersSuppliersController::class, 'Buyers_method']);
Route::get('Suppliers', [App\Http\Controllers\BuyersSuppliersController::class, 'Suppliers_method']);
Route::get('Buyers_Suppliers_1', [App\Http\Controllers\BuyersSuppliersController::class, 'Buyers_Suppliers_1_method']);
Route::post('insertBuyers_Suppliers', [App\Http\Controllers\BuyersSuppliersController::class, 'insertBuyers_Suppliers_method']);
Route::get('Buyers_SuppliersEdit', [App\Http\Controllers\BuyersSuppliersController::class, 'Buyers_SuppliersEdit_method']);
Route::post('updateBuyers_Suppliers', [App\Http\Controllers\BuyersSuppliersController::class, 'updateBuyers_Suppliers_method']);
Route::get('Buyers_SuppliersDelete', [App\Http\Controllers\BuyersSuppliersController::class, 'Buyers_SuppliersDelete_method']);

// User Type Code starts from here
// api duplicate route
Route::get('User', [App\Http\Controllers\UserController::class, 'User_method']);
Route::get('User_1', [App\Http\Controllers\UserController::class, 'User_1_method']);
Route::post('InsertUser', [App\Http\Controllers\UserController::class, 'insertUser_method']);
Route::get('UserEdit', [App\Http\Controllers\UserController::class, 'UserEdit_method']);
Route::post('UpdateUser', [App\Http\Controllers\UserController::class, 'updateUser_method']);
Route::get('UserDelete', [App\Http\Controllers\UserController::class, 'UserDelete_method']);
Route::get('ShowUsers', [App\Http\Controllers\UserController::class, 'ShowUsers']);


// User Type Code starts from here
// api duplicate route
Route::get('Usertype', [App\Http\Controllers\UserController::class, 'Usertype_method']);
Route::get('Usertype_1', [App\Http\Controllers\UserController::class, 'Usertype_1_method']);
Route::post('insertUserType', [App\Http\Controllers\UserController::class, 'insertUsertype_method']);
Route::get('UsertypeEdit', [App\Http\Controllers\UserController::class, 'UsertypeEdit_method']);
Route::post('updateUserType', [App\Http\Controllers\UserController::class, 'updateUsertype_method']);
Route::get('UsertypeDelete', [App\Http\Controllers\UserController::class, 'UsertypeDelete_method']);
Route::get('/ShowUserTypes', [App\Http\Controllers\UserController::class, 'ShowUserTypes']);


// Expense Type Code starts from here
Route::get('Expense_1', [App\Http\Controllers\ExpenseController::class, 'Expense_1_method']);
Route::post('insertExpense', [App\Http\Controllers\ExpenseController::class, 'insertExpense_method']);
Route::get('ExpenseTypeEdit', [App\Http\Controllers\ExpenseController::class, 'ExpenseTypeEdit_method']);
Route::post('updateExpenseType', [App\Http\Controllers\ExpenseController::class, 'updateExpenseType_method']);
Route::get('ExpenseTypeDelete', [App\Http\Controllers\ExpenseController::class, 'ExpenseTypeDelete_method']);


// Expense Type Code starts from here
Route::get('ExpenseType_1', [App\Http\Controllers\ExpenseController::class, 'ExpenseType_1_method']);
Route::post('insertExpenseType', [App\Http\Controllers\ExpenseController::class, 'insertExpenseType_method']);
Route::get('ExpenseTypeEdit', [App\Http\Controllers\ExpenseController::class, 'ExpenseTypeEdit_method']);
Route::post('updateExpenseType', [App\Http\Controllers\ExpenseController::class, 'updateExpenseType_method']);
Route::get('ExpenseTypeDelete', [App\Http\Controllers\ExpenseController::class, 'ExpenseTypeDelete_method']);


// Expense Type starts from here
Route::get('Expense', [App\Http\Controllers\ExpenseController::class, 'Expense_method']);
Route::get('Expense_1', [App\Http\Controllers\ExpenseController::class, 'Expense_1_method']);
Route::post('insertExpense', [App\Http\Controllers\ExpenseController::class, 'insertExpense_method']);
Route::get('ExpenseEdit', [App\Http\Controllers\ExpenseController::class, 'ExpenseEdit_method']);
Route::post('updateExpense', [App\Http\Controllers\ExpenseController::class, 'updateExpense_method']);
Route::get('ExpenseDelete', [App\Http\Controllers\ExpenseController::class, 'ExpenseDelete_method']);


// Expense Type starts from here
Route::get('Cashbook', [App\Http\Controllers\CashbookController::class, 'Cashbook_method']);
Route::get('Cashbook_1', [App\Http\Controllers\CashbookController::class, 'Cashbook_1_method']);
Route::post('insertCashbook', [App\Http\Controllers\CashbookController::class, 'insertCashbook_method']);
Route::get('CashbookEdit', [App\Http\Controllers\CashbookController::class, 'CashbookEdit_method']);
Route::post('updateCashbook', [App\Http\Controllers\CashbookController::class, 'updateCashbook_method']);
Route::get('CashbookDelete', [App\Http\Controllers\CashbookController::class, 'CashbookDelete_method']);


// Store code starts from here
Route::get('Store', [App\Http\Controllers\StoreController::class, 'Store_method']);
Route::get('Store_1', [App\Http\Controllers\StoreController::class, 'Store_1_method']);
Route::post('insertStore', [App\Http\Controllers\StoreController::class, 'insertStore_method']);
Route::get('StoreEdit', [App\Http\Controllers\StoreController::class, 'StoreEdit_method']);
Route::post('updateStore', [App\Http\Controllers\StoreController::class, 'updateStore_method']);
Route::get('StoreDelete', [App\Http\Controllers\StoreController::class, 'StoreDelete_method']);


// Item Category starts from here
Route::get('ItemCategory', [App\Http\Controllers\StoreController::class, 'ItemCategory_method']);
Route::get('ItemCategory_1', [App\Http\Controllers\StoreController::class, 'ItemCategory_1_method']);
Route::post('insertItemCategory', [App\Http\Controllers\StoreController::class, 'insertItemCategory_method']);
Route::get('ItemCategoryEdit', [App\Http\Controllers\StoreController::class, 'ItemCategoryEdit_method']);
Route::post('updateItemCategory', [App\Http\Controllers\StoreController::class, 'updateItemCategory_method']);
Route::get('ItemCategoryDelete', [App\Http\Controllers\StoreController::class, 'ItemCategoryDelete_method']);


// Item Sub Category starts from here
Route::get('ItemSubCategory', [App\Http\Controllers\StoreController::class, 'ItemSubCategory_method']);
Route::get('ItemSubCategory_1', [App\Http\Controllers\StoreController::class, 'ItemSubCategory_1_method']);
Route::post('insertItemSubCategory', [App\Http\Controllers\StoreController::class, 'insertItemSubCategory_method']);
Route::get('ItemSubCategoryEdit', [App\Http\Controllers\StoreController::class, 'ItemSubCategoryEdit_method']);
Route::post('updateItemSubCategory', [App\Http\Controllers\StoreController::class, 'updateItemSubCategory_method']);
Route::get('ItemSubCategoryDelete', [App\Http\Controllers\StoreController::class, 'ItemSubCategoryDelete_method']);

// Menu code starts from here
Route::get('Menu', [App\Http\Controllers\MenuController::class, 'Menu_method']);
Route::get('Menu_1', [App\Http\Controllers\MenuController::class, 'Menu_1_method']);
Route::post('insertMenu', [App\Http\Controllers\MenuController::class, 'insertMenu_method']);
Route::get('MenuEdit', [App\Http\Controllers\MenuController::class, 'MenuEdit_method']);
Route::post('updateMenu', [App\Http\Controllers\MenuController::class, 'updateMenu_method']);
Route::get('MenuDelete', [App\Http\Controllers\MenuController::class, 'MenuDelete_method']);

// SubMenu code starts from here
Route::get('SubMenu', [App\Http\Controllers\MenuController::class, 'SubMenu_method']);
Route::get('SubMenu_1', [App\Http\Controllers\MenuController::class, 'SubMenu_1_method']);
Route::post('insertSubMenu', [App\Http\Controllers\MenuController::class, 'insertSubMenu_method']);
Route::get('SubMenuEdit', [App\Http\Controllers\MenuController::class, 'SubMenuEdit_method']);
Route::post('updateSubMenu', [App\Http\Controllers\MenuController::class, 'updateSubMenu_method']);
Route::get('SubMenuDelete', [App\Http\Controllers\MenuController::class, 'SubMenuDelete_method']);

// Dish code starts from here
Route::get('Dish', [App\Http\Controllers\MenuController::class, 'Dish_method']);
Route::get('Dish_1', [App\Http\Controllers\MenuController::class, 'Dish_1_method']);
Route::post('insertDish', [App\Http\Controllers\MenuController::class, 'insertDish_method']);
Route::get('DishEdit', [App\Http\Controllers\MenuController::class, 'DishEdit_method']);
Route::post('updateDish', [App\Http\Controllers\MenuController::class, 'updateDish_method']);
Route::get('DishDelete', [App\Http\Controllers\MenuController::class, 'DishDelete_method']);

// Unit Code starts from here
Route::get('Unit_1', [App\Http\Controllers\UnitController::class, 'Unit_1_method']);
Route::post('insertUnit', [App\Http\Controllers\UnitController::class, 'insertUnit_method']);
Route::get('UnitEdit', [App\Http\Controllers\UnitController::class, 'UnitEdit_method']);
Route::post('updateUnit', [App\Http\Controllers\UnitController::class, 'updateUnit_method']);
Route::get('UnitDelete', [App\Http\Controllers\UnitController::class, 'UnitDelete_method']);


// Raw Item code starts from here
Route::get('RawItems', [App\Http\Controllers\RawItemsController::class, 'RawItems_method']);
Route::get('RawItems_1', [App\Http\Controllers\RawItemsController::class, 'RawItems_1_method']);
Route::post('insertRawItems', [App\Http\Controllers\RawItemsController::class, 'insertRawItems_method']);
Route::get('RawItemsEdit', [App\Http\Controllers\RawItemsController::class, 'RawItemsEdit_method']);
Route::post('updateRawItems', [App\Http\Controllers\RawItemsController::class, 'updateRawItems_method']);
Route::get('RawItemsDelete', [App\Http\Controllers\RawItemsController::class, 'RawItemsDelete_method']);

// RawItemsStock code starts from here
Route::get('RawItemStock', [App\Http\Controllers\RawItemsController::class, 'RawItemStock_method']);
Route::get('RawItemStock_1', [App\Http\Controllers\RawItemsController::class, 'RawItemStock_1_method']);
Route::post('insertRawItemStock', [App\Http\Controllers\RawItemsController::class, 'insertRawItemStock_method']);
Route::get('RawItemStockEdit', [App\Http\Controllers\RawItemsController::class, 'RawItemStockEdit_method']);
Route::post('updateRawItemStock', [App\Http\Controllers\RawItemsController::class, 'updateRawItemStock_method']);
Route::get('RawItemStockDelete', [App\Http\Controllers\RawItemsController::class, 'RawItemStockDelete_method']);
