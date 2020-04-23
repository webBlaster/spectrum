<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LicenseResourceCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $now = Carbon::now();
        // $number_of_books = count(explode(',', $this->books_contained));
        $number_of_books = count($this->books);
        if($this->expires !== NULL && $this->expires !== "") {
            if($this->expires >= $now) {
                $status = "in use";
            } elseif($this->expires < $now) {
                $status = "expired";
            }   
        } else {
            $status = 'idle';
        }
        return [
            'uuid' => $this->uuid,
            'code' =>  $this->code,
            'license_name' =>  $this->license_name,
            'license_type' => $this->group->name,
            'books_number' => $number_of_books,
            'price' => 'N '. $this->price,
            'max_number_of_users' => $this->max_number_of_users,
            'duration' => $this->duration . ' ' . Str::plural('month', $this->duration),
            'status' => $status
        ];
    }
}
