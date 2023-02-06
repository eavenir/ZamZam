<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountHead;
use App\Traits\InvoiceTrait;

class AccountHeadController extends Controller
{
    use InvoiceTrait;
    public function AccountHead_method(Request $request)
    {
        $AccountHeads = new AccountHead();

        return view('admin/modules/Accounts/AccountHead', ['AccountHeads' => $AccountHeads->get()]);
    }

    public function AccountHead_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $AccountHead = new AccountHead();
            $array_result = [];
            $count =  count($AccountHead->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $AccountHead->get()[$a]->id,
                    'AccountHead' => $AccountHead->get()[$a]->AccountHead,
                    'VatNo' => $AccountHead->get()[$a]->VatNo,
                    'Vat' => $AccountHead->get()[$a]->Vat,
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

    public function insertAccountHead_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $AccountHead = new AccountHead();
            $AccountHead->AccountHead = $request->AccountHead;
            $AccountHead->AccountHead_Arabic = $request->AccountHead_Arabic;
            $AccountHead->Cell = $request->Cell;
            $AccountHead->Email = $request->Email;
            $AccountHead->Address = $request->Address;
            $AccountHead->VatNo = $request->VatNo;
            $AccountHead->Vat = $request->Vat;
            $insertAccountHead =  $AccountHead->save();

            if ($insertAccountHead) {
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

    public function AccountHeadEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $AccountHead = new AccountHead();
            return $AccountHead->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateAccountHead_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $AccountHead = new AccountHead();
            $updatedAccountHead = $AccountHead->where('id', $request->id)->update([
                'AccountHead' => $request->AccountHead,
                'AccountHead_Arabic' => $request->AccountHead_Arabic,
                'Cell' => $request->Cell,
                'Email' => $request->Email,
                'Address' => $request->Address,
                'VatNo' => $request->VatNo,
                'Vat' => $request->Vat,
            ]);

            if ($updatedAccountHead) {
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

    public function AccountHeadDelete_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $AccountHead = new AccountHead();
            $deleted =  $AccountHead
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
