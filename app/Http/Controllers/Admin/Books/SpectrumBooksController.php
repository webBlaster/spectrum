<?php

namespace App\Http\Controllers\Admin\Books;

use App\Book;
use App\DeveloperApiKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpectrumBooksController extends Controller
{
    public function __construct() {
        return $this->middleware('auth.custom');
    }
    public function index()
    {
        return view('books.uploaded-books');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create_book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_name.*' => 'image|mimes:jpg, jpeg, png, gif, bmp',
        ]);

        $images = $this->uploadFiles($request);

        foreach($images as $imageFile) {
            list($fileName, $title) = $imageFile;
            $image = new Book();
            $image->title = $title;
            $image->file_name = $fileName;
            $image->save();
        }       

        return redirect('/')->with('message', "Your Image Was Successfully Uploaded");
    }

    protected function uploadFiles($request)
    {
        $uploadImages = [];
        if ($request->hasFile('file_name')) {
            $images = $request->file('file_name');
            foreach($images as $image) {
                $uploadImages = $this->uploadFile($image);
            }
        }

        return $uploadImages;
    }
    protected function uploadFile($image) {
            
        $originalFileName = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
        $fileName = Str::slug($fileNameOnly) . "-" . time() . "." . $extension;
        $uploadedFileName = $image->storeAs('public', $fileName);
    
        return [$uploadedFileName, $fileNameOnly];
            // during call back, you can use a getter and say
            // retun Storage::url($this->file_name)
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
