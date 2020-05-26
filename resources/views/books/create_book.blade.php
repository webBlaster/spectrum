@extends('layouts.layout')
@section('content')
<!--Create Books-->
<main class="content-wrapper">
    <form method="POST" action="{{ route('books/create-books') }}" enctype="multipart/form-data">
        @csrf
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
                @if ($errors->any())
                <flash-error message="{{$errors->first()}}"></flash-error>
                @endif
                <div class="d-flex justify-content-between">

                    <div class="mdc-card">
                        <h6 class="card-title">Upload Book</h6>
                        <div class="template-demo">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field">
                                        <input class="mdc-text-field__input" id="text-field-hero-input" name="title"
                                            type="text" required>
                                        <div class="mdc-line-ripple"></div>
                                        <label for="text-field-hero-input" class="mdc-floating-label">Book Title</label>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                    <div class="mdc-text-field mdc-text-field--outlined">
                                        <input class="mdc-text-field__input" id="text-field-hero-input" name="author"
                                            type="text" required>
                                        <div class="mdc-notched-outline">
                                            <div class="mdc-notched-outline__leading"></div>
                                            <div class="mdc-notched-outline__notch">
                                                <label for="text-field-hero-input" class="mdc-floating-label">Book
                                                    Author</label>
                                            </div>
                                            <div class="mdc-notched-outline__trailing"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                    <div
                                        class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon">

                                        <input readonly value="Spectrum Book Publishers" class="mdc-text-field__input" id="text-field-hero-input" type="text"
                                            name="publisher" required>
                                        <div class="mdc-notched-outline">
                                            <div class="mdc-notched-outline__leading"></div>
                                            <div class="mdc-notched-outline__notch">
                                                <label for="text-field-hero-input" class="mdc-floating-label">Book
                                                    Publisher</label>
                                            </div>
                                            <div class="mdc-notched-outline__trailing"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                    <div
                                        class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon">

                                        <input class="mdc-text-field__input" id="text-field-hero-input" type="date"
                                            name="date_published" required max="{{ date('Y-m-g') }}">
                                        <div class="mdc-notched-outline">
                                            <div class="mdc-notched-outline__leading"></div>
                                            <div class="mdc-notched-outline__notch">
                                                <label for="text-field-hero-input" class="mdc-floating-label">Date
                                                    Published</label>
                                            </div>
                                            <div class="mdc-notched-outline__trailing"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell--span-12">
                                    <div class="mdc-card">
                                        <div class="template-demo">
                                            <div class="mdc-layout-grid__inner">
                                                <label>Book Description</label>
                                                <div
                                                    class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                                                    <textarea name="description" min="10" max="500"
                                                        class="mdc-text-field__input" id="text-field-hero-input"
                                                        required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                    <div><label for="file-input" class=" form-control-label">Book Cover</label> &nbsp;
                                        &nbsp;
                                        <input type="file" id="file-input" name="front_cover" required
                                            class="form-control-file">
                                    </div>
                                </div>
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                    <div><label for="file-input" class=" form-control-label">Upload Book</label> &nbsp;
                                        &nbsp;
                                        <input type="file" id="file-input" required name="book"
                                            class="form-control-file">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="mdc-card">
            {{-- <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop">
                <file-upload></file-upload>
            </div>

            <image-upload></image-upload> --}}
            <div class="text-center col-md-12">
                <button type="submit" class="mdc-button mdc-button--raised">
                    Submit
                </button>
            </div>
        </div>




    </form>
</main>
@endsection
