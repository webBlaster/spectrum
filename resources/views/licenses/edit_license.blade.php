@extends('layouts.layout')

    @section('content')
        <!--Edit License-->             
        <main class="content-wrapper">
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mdc-card">
                            <div class="template-demo">
                                <edit-license license_id="{{$license_id}}"></edit-license>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        
    @endsection
