<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CostCenterName;
use App\Traits\InvoiceTrait;

class CostCenterNameController extends Controller
{
    use InvoiceTrait;
    // Cost Center Name Code starts from here

    public function CostCenter_method(Request $request)
    {
        $CostCenterNames = new CostCenterName();

        return view('admin/modules/Accounts/CostCenterName', ['CostCenterNames' => $CostCenterNames->get()]);
    }

    public function CostCenterName_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $CostCenterName = new CostCenterName();
            $array_result = [];
            $count =  count($CostCenterName->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $CostCenterName->get()[$a]->id,
                    'CostCenterName' => $CostCenterName->get()[$a]->CostCenterName,
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

    public function insertCostCenterName_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $CostCenterName = new CostCenterName();
            $CostCenterName->CostCenterName = $request->CostCenterName;
            $insertCostCenterName =  $CostCenterName->save();

            if ($insertCostCenterName) {
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

    public function CostCenterNameEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $CostCenterName = new CostCenterName();
            return $CostCenterName->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateCostCenterName_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $CostCenterName = new CostCenterName();
            $updatedCostCenterName = $CostCenterName->where('CostCenterName', $request->id)->update([
                'CostCenterName' => $request->CostCenterName,
            ]);

            if ($updatedCostCenterName) {
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

    public function CostCenterNameDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $CostCenterName = new CostCenterName();
            $deleted =  $CostCenterName
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
