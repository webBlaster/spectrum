<?php

namespace App\Http\Resources;

use App\Book;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LicenseKey extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $now = Carbon::now();
        // $number_of_books = Book::find(explode(',', $this->books_contained));
        $number_of_books = $this->books;
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
            'license_type' => $this->group_id,
            'books_number' => $number_of_books,
            'price' => $this->price,
            'max_number_of_users' => $this->max_number_of_users,
            'duration' => $this->duration,
            'status' => $status
        ];
    }
}
