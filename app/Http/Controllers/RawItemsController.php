<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountHead;
use App\Models\ItemSubCategory;
use App\Models\RawItems;
use App\Models\RawItemsStock;
use App\Models\Store;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Traits\InvoiceTrait;

class RawItemsController extends Controller
{
    use InvoiceTrait;
    // Menu Code starts from here

    public function RawItems_method(Request $request)
    {
        $Unit = new Unit();
        $ItemSubCategory = new ItemSubCategory();
        $RawItem = new RawItems();
        $Store = new Store();
        $Account_Head = new AccountHead();
        return view('admin/modules/StoreManagment/RawItems/RawItems', [
            'Unit' => $Unit->get(),
            'ItemSubCategory' => $ItemSubCategory->get(),
            'RawItem' => $RawItem->get(),
            'Store' => $Store->get(),
            'Account_Head' => $Account_Head->get()
        ]);
    }

    public function RawItems_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $RawItem = new RawItems();
            $ItemSubCategory = new ItemSubCategory();
            $Unit = new Unit();
            $array_result = [];
            $count =  count($RawItem->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $RawItem->get()[$a]->ItemId,
                    'ItemName' => $RawItem->get()[$a]->ItemName,
                    'ItemName_Arabic' => $RawItem->get()[$a]->ItemName_Arabic,
                    'ItemSubCategory' => $ItemSubCategory->where('SubCategoryId', $RawItem->get()[$a]->ItemSubCategoryId)->first('SubCategory')->SubCategory,
                    'Unit' => $Unit->where('id', $RawItem->get()[$a]->Unit)->first('Unit')->Unit,
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

    public function insertRawItems_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $RawItem = new RawItems();
            $RawItem->ItemName = $request->ItemName;
            $RawItem->ItemName_Arabic = $request->ItemName_Arabic;
            $RawItem->ItemSubCategoryId = $request->ItemSubCategory;
            $RawItem->Unit = $request->Unit;
            $insertRawItem =  $RawItem->save();

            if ($insertRawItem) {
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

    public function RawItemsEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $RawItem = new RawItems();
            $Unit = new Unit();
            $ItemSubCategory = new ItemSubCategory();
            return  [
                'RawItem' => $RawItem->where('ItemId', $request->id)->first(),
                'Unit' => $Unit->get(),
                'ItemSubCategory' => $ItemSubCategory->get()
            ];
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateRawItems_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $RawItem = new RawItems();
            $updatedRawItem = $RawItem->where('ItemId', $request->id)->update([
                'ItemName' => $request->ItemName,
                'ItemName_Arabic' => $request->ItemName_Arabic,
                'ItemSubCategoryId' => $request->ItemSubCategory,
                'Unit' => $request->Unit,
            ]);

            if ($updatedRawItem) {
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

    public function RawItemsDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $RawItem = new RawItems();
            $deleted =  $RawItem
                ->where('ItemId', $request->id)
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


    // Raw Item Stock code starts from here

    public function RawItemStock_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $RawItemStock = new RawItemsStock();
            $RawItem = new RawItems();
            $Store = new Store();
            $array_result = [];
            $count =  count($RawItemStock->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $RawItemStock->get()[$a]->id,
                    'ItemId' => $RawItem->where('ItemId', $RawItemStock->get()[$a]->ItemId)->first('ItemName')->ItemName,
                    'PRate' => $RawItemStock->get()[$a]->PRate,
                    'VAT' => $RawItemStock->get()[$a]->VAT,
                    'SRate' => $RawItemStock->get()[$a]->SRate,
                    'Qty' => $RawItemStock->get()[$a]->Qty,
                    'StoreName' => $Store->where('StoreId', $RawItemStock->get()[$a]->StoreName)->first('StoreName')->StoreName,
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

    public function insertRawItemStock_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Account_Head = new AccountHead();
            $RawItemStock = new RawItemsStock();
            $RawItemStock->ItemId = $request->ItemName;
            $RawItemStock->PRate = $request->PRate;
            $RawItemStock->VAT = $request->VAT;
            $RawItemStock->SRate = $request->SRate;
            $RawItemStock->Qty = $request->Qty;
            $RawItemStock->StoreName = $request->Store;
            $RawItemStock->AccountId = $Account_Head->where('AccountHead', $request->AccountId)->first('id')->id;
            $insertRawItemStock =  $RawItemStock->save();

            if ($insertRawItemStock) {
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

    public function RawItemStockEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $RawItemStock = new RawItemsStock();
            $Store = new Store();
            $RawItem = new RawItems();
            return  [
                'RawItemStock' => $RawItemStock->where('id', $request->id)->first(),
                'Store' => $Store->get(),
                'RawItem' => $RawItem->get()
            ];
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateRawItemStock_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $RawItemStock = new RawItemsStock();
            $updatedRawItemStock = $RawItemStock->where('id', $request->id)->update([
                'ItemId' => $request->ItemName,
                'PRate' => $request->PRate,
                'VAT' => $request->VAT,
                'SRate' => $request->SRate,
                'Qty' => $request->Qty,
                'StoreName' => $request->Store,
            ]);

            if ($updatedRawItemStock) {
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

    public function RawItemStockDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $RawItemsStock = new RawItemsStock();
            $deleted =  $RawItemsStock
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
