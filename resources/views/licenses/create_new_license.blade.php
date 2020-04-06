@extends('layouts.layout')

    @section('content')
        <!--Create License-->             
        <main class="content-wrapper">
            <div  class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12" >
                <div class="mdc-card bg-success text-white">
                    <div class="d-flex justify-content-between">
                        <h3 class="font-weight-normal">Create License</h3>
                    </div>
                </div>
            </div>

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mdc-card">
                            <div class="template-demo">
                                <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                                    <input type="hidden" name="enhanced-select">
                                    <i class="mdc-select__dropdown-icon"></i>
                                    <div class="mdc-select__selected-text"></div>
                                    <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                                        <ul class="mdc-list">
                                            <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                                            </li>
                                            <li class="mdc-list-item" data-value="grains">
                                                Single
                                            </li>
                                            <li class="mdc-list-item" data-value="vegetables">
                                                Group
                                            </li>
                                        </ul>
                                    </div>
                                    <span class="mdc-floating-label">License Type</span>
                                    <div class="mdc-line-ripple"></div>
                                </div>
                            </div>
                
                            <div class="template-demo">
                                <div class="mdc-layout-grid__inner">
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                        <div class="mdc-text-field">
                                            <input class="mdc-text-field__input" id="text-field-hero-input">
                                            <div class="mdc-line-ripple"></div>
                                            <label for="text-field-hero-input" class="mdc-floating-label">License Name</label>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                        <div class="mdc-text-field mdc-text-field--outlined">
                                            <input class="mdc-text-field__input" id="text-field-hero-input">
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label for="text-field-hero-input" class="mdc-floating-label">License Duration</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                        <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon">
                                            <input class="mdc-text-field__input" id="text-field-hero-input">
                                            <div class="mdc-notched-outline">
                                                <div class="mdc-notched-outline__leading"></div>
                                                <div class="mdc-notched-outline__notch">
                                                    <label for="text-field-hero-input" class="mdc-floating-label">Max Number of Users</label>
                                                </div>
                                                <div class="mdc-notched-outline__trailing"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!---------Select books-->
                                <div  class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                    <div  class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop"><h6 class="card-sub-title">Select books</h6></div></br>
                                        <!--select box-->
                                        <div class="template-demo" >
                                            <div class="mdc-form-field">
                                                <div class="mdc-checkbox">
                                                    <input type="checkbox"
                                                        class="mdc-checkbox__native-control"
                                                        id="checkbox-1"/>
                                                    <div class="mdc-checkbox__background">
                                                        <svg class="mdc-checkbox__checkmark"
                                                            viewBox="0 0 24 24">
                                                            <path class="mdc-checkbox__checkmark-path"
                                                                fill="none"
                                                                d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                                                        </svg>
                                                        <div class="mdc-checkbox__mixedmark"></div>
                                                    </div>
                                                </div>
                                                <label for="checkbox-1">Mathematics For Junior Secondary Schools 3</label>
                                            </div>
                                        </div>
                                        <!---selectbox-->
                                        <div  class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                            <div class="template-demo">
                                                <div class="mdc-form-field">
                                                    <div class="mdc-checkbox">
                                                        <input type="checkbox"
                                                                class="mdc-checkbox__native-control"
                                                                id="checkbox-1"/>
                                                        <div class="mdc-checkbox__background">
                                                            <svg class="mdc-checkbox__checkmark"
                                                                viewBox="0 0 24 24">
                                                            <path class="mdc-checkbox__checkmark-path"
                                                                    fill="none"
                                                                    d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
                                                            </svg>
                                                            <div class="mdc-checkbox__mixedmark"></div>
                                                        </div>
                                                    </div>
                                                    <label for="checkbox-1">Geography Book 3</label>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Create license btn-->
                                        <div  class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                            <button class="mdc-button mdc-button--raised filled-button--info">
                                                Create License
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        
    @endsection

