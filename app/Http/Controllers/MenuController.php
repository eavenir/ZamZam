<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\ItemSubCategory;
use App\Models\Menu;
use App\Models\RawItems;
use App\Models\Store;
use App\Models\SubMenu;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Traits\InvoiceTrait;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    use InvoiceTrait;
    // Menu Code starts from here

    public function RawItems_method(Request $request)
    {
        $Menu = new Menu();
        $SubMenu = new SubMenu();
        return view('admin/modules/StoreManagment/RawItems/RawItems', ['Menu' => $Menu->get(), 'SubMenu' => $SubMenu->get()]);
    }

    public function Dish_method(Request $request)
    {

        $ItemSubCategory = new ItemSubCategory();
        $Unit = new Unit();
        $RawItem = new RawItems();
        $Store = new Store();
        return view('admin/modules/StoreManagment/RawItems/RawItems', [
            'ItemSubCategory' => $ItemSubCategory->get(),
            'Unit' => $Unit->get(),
            'RawItem' => $RawItem->get(),
            'Store' => $Store->get()
        ]);
    }

    public function Menu_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Menu = new Menu();
            $array_result = [];
            $count =  count($Menu->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $Menu->get()[$a]->id,
                    'Menu' => $Menu->get()[$a]->Menu,
                ]);
            }
            return $array_result;
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function insertMenu_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Menu = new Menu();
            $Menu->Menu = $request->Menu;
            $insertMenu =  $Menu->save();

            if ($insertMenu) {
                return 'inserted';
            }
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function MenuEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Menu = new Menu();
            return $Menu->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateMenu_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Menu = new Menu();
            $updatedMenu = $Menu->where('id', $request->id)->update([
                'Menu' => $request->Menu,
            ]);

            if ($updatedMenu) {
                return 'updated';
            }
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function MenuDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Menu = new Menu();
            $deleted =  $Menu
                ->where('id', $request->id)
                ->delete();
            if ($deleted) {
                return 'deleted';
            }
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }


    // Sub Menu code starts from here

    public function SubMenu_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Menu = new Menu();
            $SubMenu = new SubMenu();
            $array_result = [];
            $count =  count($SubMenu->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $SubMenu->get()[$a]->Id,
                    'SubMenu' => $SubMenu->get()[$a]->SubMenu,
                    'Menu' => $Menu->where('id', $SubMenu->get()[$a]->MenuId)->first('Menu')->Menu,
                ]);
            }
            return $array_result;
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function insertSubMenu_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $SubMenu = new SubMenu();
            $SubMenu->SubMenu = $request->SubMenu;
            $SubMenu->MenuId = $request->Menu;
            $insertSubMenu =  $SubMenu->save();

            if ($insertSubMenu) {
                return 'inserted';
            }
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function SubMenuEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $SubMenu = new SubMenu();
            $Menu = new Menu();
            return ['SubMenu' => $SubMenu->where('Id', $request->id)->first(), 'Menu' => $Menu->get()];
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateSubMenu_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $SubMenu = new SubMenu();
            $updatedSubMenu = $SubMenu->where('Id', $request->id)->update([
                'SubMenu' => $request->SubMenu,
                'MenuId' => $request->Menu,
            ]);

            if ($updatedSubMenu) {
                return 'updated';
            }
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function SubMenuDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $SubMenu = new SubMenu();
            $deleted =  $SubMenu
                ->where('Id', $request->id)
                ->delete();
            if ($deleted) {
                return 'deleted';
            }
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }


    // Dish code starts from here
    public function Dish_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Dish = new Dish();
            $SubMenu = new SubMenu();
            $array_result = [];
            $count =  count($Dish->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $Dish->get()[$a]->id,
                    'SubMenuId' => $SubMenu->where('Id', $Dish->get()[$a]->SubMenuId)->first('SubMenu')->SubMenu,
                    'DishName' => $Dish->get()[$a]->DishName,
                    'DishName_Arabic' => $Dish->get()[$a]->DishName_Arabic,
                ]);
            }
            return $array_result;
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function insertDish_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Dish = new Dish();
            $Dish->SubMenuId = $request->SubMenu;
            $Dish->DishName = $request->DishName;
            $Dish->DishName_Arabic = $request->DishName_Arabic;
            $insertDish =  $Dish->save();

            if ($insertDish) {
                return 'inserted';
            }
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function DishEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Dish = new Dish();
            $SubMenu = new SubMenu();
            return ['Dish' => $Dish->where('id', $request->id)->first(), 'SubMenu' => $SubMenu->get()];
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateDish_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Dish = new Dish();
            $updatedDish = $Dish->where('id', $request->id)->update([
                'SubMenuId' => $request->SubMenu,
                'DishName' => $request->DishName,
                'DishName_Arabic' => $request->DishName_Arabic,
            ]);

            if ($updatedDish) {
                return 'updated';
            }
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function DishDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Dish = new Dish();
            $deleted =  $Dish
                ->where('id', $request->id)
                ->delete();
            if ($deleted) {
                return 'deleted';
            }
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }
}
