<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeCategory;
use App\Traits\InvoiceTrait;

class EmployeeCategoryController extends Controller
{
    use InvoiceTrait;

    public function EmployeeCategory_1_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $EmployeeCategory = new EmployeeCategory();
            $array_result = [];
            $count =  count($EmployeeCategory->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $EmployeeCategory->get()[$a]->id,
                    'EmployeeCategory' => $EmployeeCategory->get()[$a]->EmployeeCategory,
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

    public function insertEmployeeCategory_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $EmployeeCategory = new EmployeeCategory();
            $EmployeeCategory->EmployeeCategory = $request->EmployeeCategory;
            $insertEmployeeCategory =  $EmployeeCategory->save();

            if ($insertEmployeeCategory) {
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

    public function EmployeeCategoryEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $EmployeeCategory = new EmployeeCategory();
            return $EmployeeCategory->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateEmployeeCategory_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $EmployeeCategory = new EmployeeCategory();
            $updatedEmployeeCategory = $EmployeeCategory->where('id', $request->id)->update([
                'EmployeeCategory' => $request->EmployeeCategory,
            ]);

            if ($updatedEmployeeCategory) {
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

    public function EmployeeCategoryDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $EmployeeCategory = new EmployeeCategory();
            $deleted =  $EmployeeCategory
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
