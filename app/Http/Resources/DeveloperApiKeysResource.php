<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DeveloperApiKeysResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $present = Carbon::now();
        if($this->valid_from > $present) {
            $status = 'Pending';
        } elseif($this->valid_from < $present && $this->valid_till < $present) {
            $status = 'Expired';
        } elseif($this->valid_from < $present && $this->valid_till > $present) {
            $status = 'Active';
        } else {
            $status = 'Unknown';
        }
        return [
            'duid' => $this->dduid,
            'key' =>  $this->key,
            'duration' => $this->duration,
            'valid_from' => $this->valid_from,
            'valid_till' => $this->valid_til,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'status' => $status,
            'expiry' => Carbon::now()->addDays($this->valid_till->diff($this->valid_from)->format("%a"))->diffInDays()
        ];
    }
}
