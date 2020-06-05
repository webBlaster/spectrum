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
        $used_access_code = AccessCode::where('code', $this->access_code)->first();
        
        $expires = '';
        $access_code_uuid = '';
        $category = '';
        if($used_access_code) {
            $expires = $used_access_code->expires;
            $access_code_uuid = $used_access_code->uuid;
            $category = $used_access_code->group;
        }
        return [
            'user_uuid'             =>              $this->uuid,
            'used_key'              =>              $this->access_code,
            'name'                  =>              strtoupper($this->first_name) . ' ' . $this->last_name,
            'device_imei'           =>              $this->imei,
            'activation_date'       =>              $this->uuiactivation_dated,
            'expires'               =>              $expires,
            'access_code_uuid'      =>              $access_code_uuid,
            'category'              =>              $category,
        ];
    }
}
