<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\ExpenseType;
use App\Models\Expense;
use App\Traits\InvoiceTrait;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    use InvoiceTrait;

    public function Expense_method()
    {
        $ExpenseType = new ExpenseType();
        $Account = new Account();
        return view('admin/modules/Expense/Expense', ['ExpenseTypes' => $ExpenseType->get(), 'Accounts' => $Account->get()]);
    }

    public function Expense_1_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Expense = new Expense();
            $ExpenseCount = $Expense->get();
            $array_result = [];
            for ($a = 0; $a < count($ExpenseCount); $a++) {
                array_push($array_result, [
                    'id' => $ExpenseCount[$a]->id,
                    'Date' => $ExpenseCount[$a]->Date,
                    'FromAccount' => DB::table('accounts')->where('id', $ExpenseCount[$a]->FromAccount)->first('AccountName')->AccountName,
                    'ExpenseType' => DB::table('expense_types')->where('id', $ExpenseCount[$a]->ExpenseType)->first('ExpenseType')->ExpenseType,
                    'Amount' => $ExpenseCount[$a]->Amount,
                    'VATPercent' => $ExpenseCount[$a]->VATPercent,
                    'VATAmount' => $ExpenseCount[$a]->VATAmount,

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

    public function insertExpense_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            $Expense = new Expense();
            $Expense->Date = $request->Date;
            $Expense->FromAccount = DB::table('accounts')->where('AccountName', $request->FromAccount)->first('id')->id;
            $Expense->ExpenseType = DB::table('expense_types')->where('ExpenseType', $request->ExpenseType)->first('id')->id;
            $Expense->Amount = $request->Amount;
            $Expense->VATPercent = $request->VATPercent;
            $Expense->VATAmount = $request->VATAmount;
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

    public function ExpenseEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Expense = new Expense();
            $ExpenseType = new ExpenseType();
            $Accounts = new Account();
            return [
                'Expense' => $Expense->where('id', $request->id)->first(),
                'ExpenseType' => $ExpenseType->get(),
                'Accounts' => $Accounts->get()
            ];
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateExpense_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Expense = new Expense();
            $UpdateExpense = $Expense->where('id', $request->id)->update([
                'Date' => $request->Date,
                'FromAccount' => DB::table('accounts')->where('AccountName', $request->FromAccount)->first('id')->id,
                'ExpenseType' => DB::table('expense_types')->where('ExpenseType', $request->ExpenseType)->first('id')->id,
                'Amount' => $request->Amount,
                'VATPercent' => $request->VATPercent,
                'VATAmount' => $request->VATAmount,
                'Remarks' => $request->Remarks,
            ]);

            if ($UpdateExpense) {
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

    public function ExpenseDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Expense = new Expense();
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
