<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\DeveloperApiKey;
use Illuminate\Http\Resources\Json\Resource;

class DeveloperApiKeysCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $present = Carbon::now();
        if($this->valid_from > $present) {
            $status = 'Pending';
            $expiry = '';
        } elseif($this->valid_from < $present && $this->valid_till < $present) {
            $status = 'Expired';
            $expiry = '';
        } elseif($this->valid_from <= $present && $this->valid_till > $present) {
            $status = 'Active';
            $expiry = '';
        } else {
            $status = 'Unknown';
            $expiry = '';
        }
        if($this->creator) {
            $creator = $this->creator->username;
        } else {
            $creator = '';
        }
        return [
            'duid' => $this->duid,
            'key' =>  $this->key,
            'duration' => $this->duration,
            'valid_from' => Carbon::parse($this->valid_from)->format('Y-m-d'),
            'valid_till' => Carbon::parse($this->valid_till)->format('Y-m-d'),
            'created_by' => $creator,
            'status' => $status,
        ];
    }
}
