@extends('layouts.layout')
    @section('content')
    <!--Create Books-->
    <main class="content-wrapper">
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
          <div class="mdc-card">
            <div class="d-flex justify-content-between">
             
              <div class="mdc-card">
                <h6 class="card-title">Create Book</h6>
                <div class="template-demo">
                  <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                      <div class="mdc-text-field">
                        <input class="mdc-text-field__input" id="text-field-hero-input">
                        <div class="mdc-line-ripple"></div>
                        <label for="text-field-hero-input" class="mdc-floating-label">Book Name</label>
                      </div>
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                      <div class="mdc-text-field mdc-text-field--outlined">
                        <input class="mdc-text-field__input" id="text-field-hero-input">
                        <div class="mdc-notched-outline">
                          <div class="mdc-notched-outline__leading"></div>
                          <div class="mdc-notched-outline__notch">
                            <label for="text-field-hero-input" class="mdc-floating-label">Book Author</label>
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
                            <label for="text-field-hero-input" class="mdc-floating-label">Book Description</label>
                          </div>
                          <div class="mdc-notched-outline__trailing"></div>
                        </div>
                      </div>
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                      <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon">
                      
                        <input class="mdc-text-field__input" id="text-field-hero-input">
                        <div class="mdc-notched-outline">
                          <div class="mdc-notched-outline__leading"></div>
                          <div class="mdc-notched-outline__notch">
                            <label for="text-field-hero-input" class="mdc-floating-label">Book Publisher</label>
                          </div>
                          <div class="mdc-notched-outline__trailing"></div>
                        </div>
                      </div>
                    </div>
                    <div  class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                                                  <div><label for="file-input" class=" form-control-label">Upload Book</label> &nbsp; &nbsp;
                                                                  <input type="file" id="file-input" name="file-input" class="form-control-file"></div>
                                                              </div>

                  </div>
                  <button class="mdc-button mdc-button--raised filled-button--info">
                    Create
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </main>      
    @endsection