<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\buyers_suppliers;
use App\Traits\InvoiceTrait;

class BuyersSuppliersController extends Controller
{
    use InvoiceTrait;
    public function Buyers_method(Request $request)
    {
        $Buyers = new buyers_suppliers();

        return view('admin/modules/Accounts/Buyers', ['Buyers_Suppliers' => $Buyers->where('AccountType','Buyer')->get()]);
    }
    public function Suppliers_method(Request $request)
    {
        $Suppliers = new buyers_suppliers();

        return view('admin/modules/Accounts/Supplier', ['Buyers_Suppliers' => $Suppliers->where('AccountType','Supplier')->get()]);
    }

    public function Buyers_Suppliers_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Buyers_Suppliers = new buyers_suppliers();
            $array_result = [];
            $count =  count($Buyers_Suppliers->where('AccountType', $request->AccountType)->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->id,
                    'AccountName' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->AccountName,
                    'AccountName_Arabic' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->AccountName_Arabic,
                    'AccountType' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->AccountType,
                    'Balance' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->Balance,
                    'Cell' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->Cell,
                    'ContactPerson' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->ContactPerson,
                    'Address' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->Address,
                    'VatNo' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->VatNo,
                    'BankDetail' => $Buyers_Suppliers->where('AccountType', $request->AccountType)->get()[$a]->BankDetail,
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

    public function insertBuyers_Suppliers_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            $AccountId = DB::table('account_heads')->where('AccountHead', $request->AccountId)->first('id')->id;
            $Buyers_Suppliers = new buyers_suppliers();
            $Buyers_Suppliers->AccountName = $request->AccountName;
            $Buyers_Suppliers->AccountName_Arabic = $request->AccountName_Arabic;
            $Buyers_Suppliers->AccountType = $request->AccountType;
            $Buyers_Suppliers->Balance = $request->Balance == '' ? 0 :  $request->Balance;
            $Buyers_Suppliers->Cell = $request->Cell;
            $Buyers_Suppliers->ContactPerson = $request->ContactPerson;
            $Buyers_Suppliers->Address = $request->Address;
            $Buyers_Suppliers->VatNo = $request->VatNo;
            $Buyers_Suppliers->BankDetail = $request->BankDetail;
            $Buyers_Suppliers->AccountId = $AccountId;
            $insertBuyers_Suppliers =  $Buyers_Suppliers->save();

            if ($insertBuyers_Suppliers) {
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

    public function Buyers_SuppliersEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            $Buyers_Suppliers = new buyers_suppliers();
            return $Buyers_Suppliers->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateBuyers_Suppliers_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Buyers_Suppliers = new buyers_suppliers();
            $updatedBuyers_Suppliers = $Buyers_Suppliers->where('id', $request->id)->update([
                'AccountName' => $request->AccountName,
                'AccountName_Arabic' => $request->AccountName_Arabic,
                'AccountType' => $request->AccountType,
                'Balance' => $request->Balance,
                'Cell' => $request->Cell,
                'ContactPerson' => $request->ContactPerson,
                'Address' => $request->Address,
                'VatNo' => $request->VatNo,
                'BankDetail' => $request->BankDetail,
            ]);

            if ($updatedBuyers_Suppliers) {
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

    public function Buyers_SuppliersDelete_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Buyers_Suppliers = new buyers_suppliers();
            $deleted =  $Buyers_Suppliers
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
