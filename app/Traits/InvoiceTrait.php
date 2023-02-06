<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait InvoiceTrait
{
    function checkloggedin($token)
    {
        $token_data =  DB::table('token')->where('token', $token)->first();
        if ($token_data) {
            $allowed_time_for_token = $token_data->time;
            $token_expire_time = $token_data->expire;
            $current_time = date('h:i:s');
            $status = ((strtotime($current_time) - strtotime($allowed_time_for_token)) / 60) % 60;
            if ($status <= $token_expire_time) {
                DB::table('token')->where('token', $token)->update([
                    'time' => date("h:i:s")
                ]);
                // return $token_data;
                return "matched";
            } else {
                //    return $status;
                DB::table('token')->where('token', $token)->delete();
                return "not matched";
            }
        }
    }
}
