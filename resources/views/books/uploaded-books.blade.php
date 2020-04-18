@extends('layouts.layout')

@section('content')
<main class="content-wrapper">
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
        <div class="mdc-card p-0">
            <h6 class="card-title card-padding pb-0">Uploaded Books </h6>
            <div class="table-responsive">
                <table class="table table-hoverable">
                    <thead>
                        <tr>
                            <th class="text-left">Book Name</th>
                            <th>Book Author</th>
                            <th>Book Description</th>
                            <th>Book Publisher</th>
                            <th>Date Published</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td class="text-left">{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->description }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ date('Y-m-d', $book->date_published) }}</td>
                            <td>
                                <button class="mdc-button mdc-button--raised icon-button filled-button--secondary">
                                    <i class="material-icons mdc-button__icon">delete</i>
                                </button>&nbsp;
                                <button class="mdc-button mdc-button--raised icon-button filled-button--success">
                                    <i class="material-icons mdc-button__icon">colorize</i>
                                </button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
