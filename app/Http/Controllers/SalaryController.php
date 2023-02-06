<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\InvoiceTrait;
use App\Models\Salary;

class SalaryController extends Controller
{
    use InvoiceTrait;

    public function Salary_1_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Salary = new Salary();
            $SalaryCount = $Salary->get();
            $array_result = [];
            for ($a = 0; $a < count($SalaryCount); $a++) {
                array_push($array_result, [
                    'id' => $SalaryCount[$a]->id,
                    'Date' => $SalaryCount[$a]->Date,
                    'SalaryMonth' => $SalaryCount[$a]->SalaryMonth,
                    'FromAccount' => $SalaryCount[$a]->FromAccount,
                    'EmployeeName' => $SalaryCount[$a]->EmployeeName,
                    'SalaryAmount' => $SalaryCount[$a]->SalaryAmount,
                    'PaidAmount' => $SalaryCount[$a]->PaidAmount,
                    'AdvanceIn' => $SalaryCount[$a]->AdvanceIn,
                    'AdvanceOut' => $SalaryCount[$a]->AdvanceOut,
                    'AccountId' => $SalaryCount[$a]->AccountId,
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

    public function insertSalary_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $EmployeeCategory = new Salary();
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

    public function SalaryEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $EmployeeCategory = new Salary();
            return $EmployeeCategory->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateSalary_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $EmployeeCategory = new Salary();
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

    public function SalaryDelete_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $EmployeeCategory = new Salary();
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
