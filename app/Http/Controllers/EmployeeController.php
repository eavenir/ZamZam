<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\EmployeeDocuments;
use App\Models\EmployeeCategory;
use App\Traits\InvoiceTrait;
use Illuminate\Support\Facades\Http;
use Nette\Utils\Json;


class EmployeeController extends Controller
{
    use InvoiceTrait;

    public function Employee_method_api($token)
    {
        $response = $this->checkloggedin($token);
        if ($response == 'matched') {
            $Employees = new Employee();
            $EmployeeCategory = new EmployeeCategory();
            $Attendance = new Attendance();
            $Account = new Account();
            return [
                'Employees' => $Employees->get(),
                'EmployeeCategory' => $EmployeeCategory->get(),
                'Attendance' => $Attendance->get(),
                'Accounts' => $Account->get()
            ];
        } else {
            return 'not matched';
        }
    }

    public function Employee_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->Employee_method_api($token);
        if ($request->token == '') {
            if ($status == 'not matched') {
                return redirect('/login');
            } else {
                return view('admin/modules/Employee/Employee', $status);
            }
        } else {
            return $status;
        }
    }

    public function insertEmployee_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $AccountId = DB::table('account_heads')->where('AccountHead', $request->AccountId)->first('id')->id;

            $Employee = new Employee();
            $Employee->EmployeeName = $request->EmployeeName;
            $Employee->EmployeeName_Arabic = $request->EmployeeName_Arabic;
            $Employee->EmployeeCategory = $request->EmployeeCategory;
            $Employee->Balance = $request->Balance == '' ? 0 : $request->Balance;
            $Employee->Cell = $request->Cell == '' ? 0 : $request->Cell;
            $Employee->Address = $request->Address;
            $Employee->BasicSalaryAllowance = $request->BasicSalaryAllowance == '' ? 0 : $request->BasicSalaryAllowance;
            $Employee->TransportAllowance = $request->TransportAllowance == '' ? 0 : $request->TransportAllowance;
            $Employee->FoodAllowance = $request->FoodAllowance == '' ? 0 : $request->FoodAllowance;
            $Employee->AccomodationAllowance = $request->AccomodationAllowance == '' ? 0 : $request->AccomodationAllowance;
            $Employee->PRAlowance = $request->PRAllowance == '' ? 0 : $request->PRAllowance;
            $Employee->ExtraAllowance = $request->ExtraAllowance == '' ? 0 : $request->ExtraAllowance;
            $Employee->WorkingHour = $request->WorkingHour == '' ? 0 : $request->WorkingHour;
            $Employee->HiringDate = $request->HiringDate;
            $Employee->FireDate = $request->FireDate;
            $Employee->Nationality = $request->Nationality;
            $Employee->PassportNo = $request->PassportNo;
            $Employee->PassportExpireDate = $request->PassportExpiryDate;
            $Employee->WorkPermit = $request->WorkPermit;
            $Employee->WorkPermitExpiryDate = $request->WorkPermitExpiryDate;
            $Employee->DrivingLicense = $request->DrivingLicense;
            $Employee->DrivingLicenseExpiryDate = $request->DrivingLicenseExpiryDate;
            $Employee->MuncipalityCard = $request->MuncipalityCard;
            $Employee->MuncipalityCardExpiryDate = $request->MuncipalityCardExpiryDate;
            $Employee->AccountId = $AccountId;

            $insertEmployee =  $Employee->save();

            if ($request->hasFile('Document_Images')) {
                for ($a = 0; $a < count($request->file('Document_Images')); $a++) {
                    $EmployeeDocuments = new EmployeeDocuments();
                    $filenameWithExt = $request->file('Document_Images')[$a]->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('Document_Images')[$a]->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $EmployeeDocuments->Document_Images = $request->file('Document_Images')[$a]->move('Images', $fileNameToStore);
                    $EmployeeDocuments->Employee_Id = $Employee->id;
                    $EmployeeDocuments->save();
                }
            }

            if ($insertEmployee) {
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

    public function EmployeeEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Employee = new Employee();
            $EmployeeDocuments = new EmployeeDocuments();
            return [
                'EmployeeData' => $Employee->where('Id', $request->id)->first(),
                'EmployeeDocuments' => $EmployeeDocuments->where('Employee_Id', $request->id)->get()
            ];
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function  updateEmployee_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            // return ($request->Delete_Document_Images);
            if (($request->Delete_Document_Images)) {
                $EmployeeDocuments = new EmployeeDocuments();
                for ($a = 0; $a < count($request->Delete_Document_Images); $a++) {
                    // return json_decode($request->Delete_Document_Images[$a])->id;
                    $EmployeeDocuments->where([
                        'id' => json_decode($request->Delete_Document_Images[$a])->id,
                        'Employee_Id' => json_decode($request->Delete_Document_Images[$a])->Employee_Id
                    ])->delete();
                }
            }
            if ($request->file('Document_Images')) {
                for ($a = 0; $a < count($request->file('Document_Images')); $a++) {
                    $EmployeeDocuments = new EmployeeDocuments();
                    $filenameWithExt = $request->file('Document_Images')[$a]->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('Document_Images')[$a]->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $EmployeeDocuments->Document_Images = $request->file('Document_Images')[$a]->move('Images', $fileNameToStore);
                    $EmployeeDocuments->Employee_Id = $request->id;
                    $EmployeeDocuments->save();
                }
            }

            $Employee = new Employee();

            $updatedEmployee = $Employee->where('id', $request->id)->update([
                'EmployeeName' => $request->EmployeeName,
                'EmployeeName_Arabic' => $request->EmployeeName_Arabic,
                'EmployeeCategory' => $request->EmployeeCategory,
                'Balance' => $request->Balance,
                'Cell' => $request->Cell,
                'Address' => $request->Address,
                'BasicSalaryAllowance' => $request->BasicSalaryAllowance,
                'TransportAllowance' => $request->TransportAllowance,
                'FoodAllowance' => $request->FoodAllowance,
                'AccomodationAllowance' => $request->AccomodationAllowance,
                'PRAlowance' => $request->PRAllowance,
                'ExtraAllowance' => $request->ExtraAllowance,
                'WorkingHour' => $request->WorkingHour,
                'HiringDate' => $request->HiringDate,
                'FireDate' => $request->FireDate,
                'Nationality' => $request->Nationality,
                'PassportNo' => $request->PassportNo,
                'PassportExpireDate' => $request->PassportExpiryDate,
                'WorkPermit' => $request->WorkPermit,
                'WorkPermitExpiryDate' => $request->WorkPermitExpiryDate,
                'DrivingLicense' => $request->DrivingLicense,
                'DrivingLicenseExpiryDate' => $request->DrivingLicenseExpiryDate,
                'MuncipalityCard' => $request->MuncipalityCard,
                'MuncipalityCardExpiryDate' => $request->MuncipalityCardExpiryDate,


            ]);

            if ($updatedEmployee) {
                return 'updated';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function EmployeeDelete_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Employee = new Employee();
            $deleted =  $Employee
                ->where('Id', $request->id)
                ->delete();
            if ($deleted) {
                return 'deleted';
            }
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }

    public function ShowEmployees(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {
            $Employees = new Employee();
            return $Employees->get();
        } else {
            if ($request->token == '') {
                return redirect('/login');
            } else {
                return $status;
            }
        }
    }


    // Attendance code starts from here

    public function Attendance_method_api($token)
    {
        $status = $this->checkloggedin($token);
        if ($status == 'matched') {
            $Attendance = new Attendance();
            return ['Attendance' => $Attendance->get()];
        } else {
            return 'not matched';
        }
    }

    public function Attendance_method(Request $request)
    {
        $token = $request->token == '' ? session('token') : $request->token;
        $status = $this->Attendance_method_api($token);
        if ($request->token == '') {
            if ($status == 'matched') {
                return view('admin/modules/Employee/Attendance');
            } else {
                return redirect('/login');
            }
        } else {
            return $status;
        }
    }

    public function Attendance_1_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Attendace = new Attendance();
            $array_result = [];
            $count =  count($Attendace->get());
            for ($a = 0; $a < $count; $a++) {
                array_push($array_result, [
                    'id' => $Attendace->get()[$a]->id,
                    'Date' => $Attendace->get()[$a]->Date,
                    'EmployeeName' => $Attendace->get()[$a]->EmployeeName,
                    'Attendance' => $Attendace->get()[$a]->Attendance,
                    'InTime' => $Attendace->get()[$a]->InTime,
                    'OutTime' => $Attendace->get()[$a]->OutTime,
                    'WorkingHours' => $Attendace->get()[$a]->WorkingHours,
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

    public function insertAttendance_method(Request $request)
    {

        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {


            $TotalSeconds =   (strtotime($request->OutTime) - strtotime($request->InTime));
            $hours = $TotalSeconds / 3600;
            $seconds = (($TotalSeconds / 60) % 60);
            $WorkingHours =  (int)$hours . ":" . (int)$seconds;


            $Attendace = new Attendance();
            $Attendace->Date = $request->Date;
            $Attendace->EmployeeName = $request->EmployeeName;
            $Attendace->Attendance = $request->Attendance;
            $Attendace->InTime = $request->InTime;
            $Attendace->OutTime = $request->OutTime;
            $Attendace->WorkingHours = $WorkingHours;
            $insertAttendace =  $Attendace->save();

            if ($insertAttendace) {
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

    public function AttendanceEdit_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $UserType = new Attendance();
            return $UserType->where('id', $request->id)->first();
        } else {
            if ($request->token == '') {
                return redirect('login');
            } else {
                return $status;
            }
        }
    }

    public function  updateAttendance_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Attendance = new Attendance();

            $TotalSeconds =   (strtotime($request->OutTime) - strtotime($request->InTime));
            $hours = $TotalSeconds / 3600;
            $seconds = (($TotalSeconds / 60) % 60);
            $WorkingHours =  (int)$hours . ":" . (int)$seconds;

            $updatedAttendance = $Attendance->where('id', $request->id)->update([
                'Date' => $request->Date,
                'EmployeeName' => $request->EmployeeName,
                'Attendance' => $request->Attendance,
                'InTime' => $request->InTime,
                'OutTime' => $request->OutTime,
                'WorkingHours' => $WorkingHours,
            ]);

            if ($updatedAttendance) {
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

    public function AttendanceDelete_method(Request $request)
    {
        $token =  $request->token == '' ? session('token') : $request->token;
        $status =  $this->checkloggedin($token);
        if ($status == 'matched') {

            $Attendance = new Attendance();
            $deleted =  $Attendance
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
