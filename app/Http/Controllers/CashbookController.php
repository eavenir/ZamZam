<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\InvoiceTrait;
use App\Models\Cashbook;
use App\Models\Account;
use App\Models\buyers_suppliers;
use Illuminate\Support\Facades\DB;

class CashbookController extends Controller
{
    use InvoiceTrait;
    public function Cashbook_method()
    {
        $Cashbook = new Cashbook();
        $Accounts = new Account();
        $buyer_suppliers = new buyers_suppliers();
        return view(
            'admin/modules/Cashbook/Cashbook',
            [
                'Cashbooks' => $Cashbook->get(),
                'Accounts' => $Accounts->get(),
                'Buyers' => $buyer_suppliers->where('AccountType', 'Buyer')->get(),
                'Suppliers' => $buyer_suppliers->where('AccountType', 'Supplier')->get()
            ]
        );
    }

    public function Cashbook_1_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Expense = new Cashbook();
            $ExpenseCount = $Expense->get();
            $array_result = [];
            for ($a = 0; $a < count($ExpenseCount); $a++) {
                array_push($array_result, [
                    'id' => $ExpenseCount[$a]->id,
                    'Date' => $ExpenseCount[$a]->Date,
                    'FromAccount' => $ExpenseCount[$a]->FromAccount,
                    'ToAccount' => $ExpenseCount[$a]->ToAccount,
                    'Amount' => $ExpenseCount[$a]->Amount,

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

    public function insertCashbook_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            $Expense = new Cashbook();
            $Expense->Date = $request->Date;
            $Expense->FromAccount = $request->FromAccount;
            $Expense->ToAccount = $request->ToAccount;
            $Expense->Amount = $request->Amount;
            $Expense->Remarks = $request->Remarks;
            $Expense->AccountId = DB::table('account_heads')->where('AccountHead', $request->AccountId)->first('id')->id;
            $insertExpense =  $Expense->save();

            if ($insertExpense) {
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

    public function CashbookEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Cashbook = new Cashbook();
            $Buyers_Suppliers = new buyers_suppliers();
            $Accounts = new Account();
            return [
                'Cashbook' => $Cashbook->where('id', $request->id)->first(),
                'Accounts' => $Accounts->get(),
                'Buyers' => $Buyers_Suppliers->where('AccountType', 'Buyer')->get(),
                'Suppliers' => $Buyers_Suppliers->where('AccountType', 'Supplier')->get()
            ];
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateCashbook_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Cashbook = new Cashbook();
            $UpdateCashbook = $Cashbook->where('id', $request->id)->update([
                'Date' => $request->Date,
                'FromAccount' => $request->FromAccount,
                'ToAccount' => $request->ToAccount,
                'Amount' => $request->Amount,
                'Remarks' => $request->Remarks,
            ]);

            if ($UpdateCashbook) {
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

    public function CashbookDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Expense = new Cashbook();
            $deleted =  $Expense
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
