<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\InvoiceTrait;
use App\Models\Unit;

class UnitController extends Controller
{
    use InvoiceTrait;
    // Unit Code starts from here

    public function Unit_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Unit = new Unit();
            $array_result = [];
            $count =  count($Unit->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $Unit->get()[$a]->id,
                    'Unit' => $Unit->get()[$a]->Unit,
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

    public function insertUnit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Unit = new Unit();
            $Unit->Unit = $request->Unit;
            $insertUnit =  $Unit->save();

            if ($insertUnit) {
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

    public function UnitEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Unit = new Unit();
            return $Unit->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateUnit_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Unit = new Unit();
            $updatedUnit = $Unit->where('id', $request->id)->update([
                'Unit' => $request->Unit,
            ]);

            if ($updatedUnit) {
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

    public function UnitDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Unit = new Unit();
            $deleted =  $Unit
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
