<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Models\buyers_suppliers;
use App\Traits\InvoiceTrait;

class AccountController extends Controller
{
    use InvoiceTrait;

    public function getHeads(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            // return ($request->LoggedIn_UserName)['id'];
            $result = [];
            $first =  DB::table('assign_head_to_users')
                ->where('User', ($request->LoggedIn_UserName)['id'])->get('AccountHead');

            for ($a = 0; $a < count($first); $a++) {
                // return $first[$a]->AccountHead;
                array_push($result, [
                    'AccountHead' => DB::table('account_heads')->where('id', $first[$a]->AccountHead)->first('AccountHead')->AccountHead
                ]);
            }
            return $result;
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }



    public function Account_method(Request $request)
    {

        $Accounts = new Account();

        $Buyers_Suppliers = new buyers_suppliers();


        return view('admin/modules/Accounts/Account', ['Accounts' => $Accounts->get(), 'Buyers_Suppliers' => $Buyers_Suppliers->get()]);
    }

    public function Account_1_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Account = new Account();
            $array_result = [];
            $count =  count($Account->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $Account->get()[$a]->id,
                    'AccountName' => $Account->get()[$a]->AccountName,
                    'AccountDetail' => $Account->get()[$a]->AccountDetail,
                    'OpeningBalance' => $Account->get()[$a]->OpeningBalance,
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

    public function insertAccount_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Account = new Account();
            $Account->AccountName = $request->AccountName;
            $Account->AccountDetail = $request->AccountDetail;
            $Account->OpeningBalance = $request->OpeningBalance == '' ? 0 : $request->OpeningBalance;
            $insertAccount =  $Account->save();

            if ($insertAccount) {
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

    public function AccountEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Account = new Account();
            return $Account->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateAccount_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Account = new Account();
            $updatedAccount = $Account->where('id', $request->id)->update([
                'AccountName' => $request->AccountName,
                'AccountDetail' => $request->AccountDetail,
                'OpeningBalance' => $request->OpeningBalance,
            ]);

            if ($updatedAccount) {
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

    public function AccountDelete_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Account = new Account();
            $deleted =  $Account
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
