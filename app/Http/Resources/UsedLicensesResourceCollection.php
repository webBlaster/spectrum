<?php

namespace App\Http\Resources;

use App\AccessCode;
use Illuminate\Http\Resources\Json\Resource;

class UsedLicensesResourceCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $access_code = AccessCode::where('code', $this->access_code)->get();
        if(count($access_code) < 1) {
            $expires = '';
            $access_code_uuid = '';
        } else {
            $expires = $access_code->expires;
            $access_code_uuid = $access_code->uuid;
        }
        return [
            'user_uuid'             =>              $this->uuid,
            'used_key'              =>              $this->access_code,
            'name'                  =>              strtoupper($this->first_name) . ' ' . $this->last_name,
            'device_imei'           =>              $this->imei,
            'activation_date'       =>              $this->activation_date,
            'expires'               =>              $expires,
            'access_code_uuid'      =>              $access_code_uuid,
        ];
    }
}
