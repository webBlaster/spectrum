@extends('layouts.layout')

@section('content')
<!--Create License-->
<main class="content-wrapper">
    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
        <div class="mdc-card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mdc-card">
                    <div class="template-demo">
                        <license-generator></license-generator>
                    </div>
                    <h4 class="text-left">Instructions for License Creation.</h4>
                    <ol>
                        <li>Generate the license key by filling and submitting the sum above.</li>
                        <li>Add the associated books to the license by marking the checkbox beside each book.</li>
                        <li>Save the generated license and the attached books.</li>
                    </ol>
                    <p class="font-weight-bold">N B. Kindly note that the license will not be saved unless all steps are
                        completed.</p>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
