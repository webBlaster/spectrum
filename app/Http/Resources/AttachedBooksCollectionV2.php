<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class AttachedBooksCollectionV2 extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $id = encrypt($this->id);
        $headers = array(
            'Content-Disposition:inline',
            'Content-Type:image/jpg'
        );
        $path = Storage::url($this->front_cover);
        
        // $response = response()->file($path, $headers);

        
        return [
            "book_title" => $this->title,
            "book_author" => $this->author,
            "book_description" => $this->description,
            "book_publisher" => $this->publisher,
            "date_published"=> $this->date_published,
            "download_link"=> route('api.download_linkv2', $id),
            "front_cover" =>  $path,
        ];
    }
}



