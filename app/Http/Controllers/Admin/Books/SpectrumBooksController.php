<?php

namespace App\Http\Controllers\Admin\Books;

use App\Book;
use App\DeveloperApiKey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class SpectrumBooksController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth.custom');
    }
    public function index()
    {
        $books = Book::all();

        return view('books.uploaded-books', ['books' => $books]);
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
            'title' => 'required|unique:books',
            'author' => 'required',
            'publisher' => 'required',
            'description' => 'required',
            'date_published' => 'required|date|before_or_equal:' . date('Y-m-d')
            // 'front_cover' => 'required|mimes:jpg, jpeg, png, gif, bmp',
            // 'book' => 'required|file|mimes:pdf,html,epub,ocr,docx,doc'
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->publisher = $request->publisher;
        $book->date_published = $request->date_published;

        $book->front_cover = $request
            ->file('front_cover')
            ->store('public/books/front-covers');

        $book->path = $request
            ->file('book')
            ->storeAs(
                'public/books',
                $request->title .
                    '.' .
                    $request->book->getClientOriginalExtension()
            );

    protected function uploadFiles($request)
    {
        $uploadImages = [];
        if ($request->hasFile('file_name')) {
            $images = $request->file('file_name');
            foreach ($images as $image) {
                $uploadImages = $this->uploadFile($image);
            }
        }

        return $uploadImages;
    }
    protected function uploadFile($image)
    {

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
    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('books.view-book', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit-book', ['book' => $book]);
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
    public function destroy(Request $request, $id)
    {
        //
    }

    public function show_trashed(Request $request)
    {
        $books = Book::onlyTrashed()->get();
        // dd($books);
        return view('books.deleted-books', ['books' => $books]);
    }

    public function restore($id)
    {
        $book = Book::withTrashed($id);
        $book->restore();

        return redirect('admin/books/deleted-books')->with(
            'success',
            'Book Successfully Restored.'
        );
    }
}