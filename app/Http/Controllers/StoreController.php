<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use App\Models\ItemSubCategory;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Traits\InvoiceTrait;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    use InvoiceTrait;
    // Store Code starts from here

    public function Store_method(Request $request)
    {

        return view('admin/modules/StoreManagment/Store',);
    }

    public function Store_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Store = new Store();
            $array_result = [];
            $count =  count($Store->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $Store->get()[$a]->StoreId,
                    'StoreName' => $Store->get()[$a]->StoreName,
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

    public function insertStore_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Store = new Store();
            $Store->StoreName = $request->StoreName;
            $Store->AccountId = DB::table('account_heads')->where('AccountHead', $request->AccountId)->first('id')->id;
            $insertStore =  $Store->save();

            if ($insertStore) {
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

    public function StoreEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Store = new Store();
            return $Store->where('StoreId', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateStore_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Store = new Store();
            $updatedStore = $Store->where('StoreId', $request->id)->update([
                'StoreName' => $request->StoreName,
            ]);

            if ($updatedStore) {
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

    public function StoreDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Store = new Store();
            $deleted =  $Store
                ->where('StoreId', $request->id)
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


    // Item Category Code starts from here

    public function ItemCategory_method(Request $request)
    {

        return view('admin/modules/StoreManagment/ItemCategory',);
    }

    public function ItemCategory_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $ItemCategory = new ItemCategory();
            $array_result = [];
            $count =  count($ItemCategory->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $ItemCategory->get()[$a]->ItemCategoryId,
                    'ItemCategory' => $ItemCategory->get()[$a]->ItemCategory,
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

    public function insertItemCategory_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $ItemCategory = new ItemCategory();
            $ItemCategory->ItemCategory = $request->ItemCategory;
            $insertItemCategory =  $ItemCategory->save();

            if ($insertItemCategory) {
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

    public function ItemCategoryEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $ItemCategory = new ItemCategory();
            return $ItemCategory->where('ItemCategoryId', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateItemCategory_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $ItemCategory = new ItemCategory();
            $updatedItemCategory = $ItemCategory->where('ItemCategoryId', $request->id)->update([
                'ItemCategory' => $request->ItemCategory,
            ]);

            if ($updatedItemCategory) {
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

    public function ItemCategoryDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $ItemCategory = new ItemCategory();
            $deleted =  $ItemCategory
                ->where('ItemCategoryId', $request->id)
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


    // Item Sub Category Code starts from here

    public function ItemSubCategory_method(Request $request)
    {
        $ItemCategory = new ItemCategory();

        return view('admin/modules/StoreManagment/ItemSubCategory', ['ItemCategory' => $ItemCategory->get()]);
    }

    public function ItemSubCategory_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $ItemSubCategory = new ItemSubCategory();
            $array_result = [];
            $count =  count($ItemSubCategory->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $ItemSubCategory->get()[$a]->SubCategoryId,
                    'SubCategory' => $ItemSubCategory->get()[$a]->SubCategory,
                    'ItemCategoryId' => DB::table('item_categories')->where('ItemCategoryId', $ItemSubCategory->get()[$a]->ItemCategoryId)->first('ItemCategory')->ItemCategory,
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

    public function insertItemSubCategory_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            // return $request;

            $ItemSubCategory = new ItemSubCategory();
            $ItemSubCategory->SubCategory = $request->ItemSubCategory;
            $ItemSubCategory->ItemCategoryId = $request->ItemCategory;
            $insertItemSubCategory =  $ItemSubCategory->save();

            if ($insertItemSubCategory) {
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

    public function ItemSubCategoryEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $ItemCategory = new ItemCategory();
            $SubCategory = new ItemSubCategory();
            return [
                'SubCategory' => $SubCategory->where('SubCategoryId', $request->id)->first(),
                'ItemCategory' => $ItemCategory->get()
            ];
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateItemSubCategory_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $ItemSubCategory = new ItemSubCategory();
            $updatedItemSubCategory = $ItemSubCategory->where('SubCategoryId', $request->id)->update([
                'SubCategory' => $request->ItemSubCategory,
                'ItemCategoryId' => $request->ItemCategory,
            ]);

            if ($updatedItemSubCategory) {
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

    public function ItemSubCategoryDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $ItemSubCategory = new ItemSubCategory();
            $deleted =  $ItemSubCategory
                ->where('SubCategoryId', $request->id)
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
