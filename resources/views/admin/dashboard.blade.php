@extends('layouts.layout')

@section('content')
  <main class="content-wrapper">
 
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
          <div class="mdc-card info-card info-card--success">
            <div class="card-inner">
              <h5 class="card-title">Granted Licenses</h5>
              <h5 class="font-weight-light pb-2 mb-1 border-bottom">457</h5>
              <p class="tx-12 text-muted"></p>
              <div class="card-icon-wrapper">
                <i class="material-icons">note</i>
              </div>
            </div>
          </div>
        </div>
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
          <div class="mdc-card info-card info-card--danger">
            <div class="card-inner">
              <h5 class="card-title">Used License Keys</h5>
              <h5 class="font-weight-light pb-2 mb-1 border-bottom">958</h5>
              <p class="tx-12 text-muted"></p>
              <div class="card-icon-wrapper">
                <i class="material-icons">track_changes</i>
              </div>
            </div>
          </div>
        </div>
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
          <div class="mdc-card info-card info-card--primary">
            <div class="card-inner">
              <h5 class="card-title">Created Books</h5>
              <h5 class="font-weight-light pb-2 mb-1 border-bottom">234</h5>
              <p class="tx-12 text-muted"></p>
              <div class="card-icon-wrapper">
                <i class="material-icons">book</i>
              </div>
            </div>
          </div>
        </div>
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
          <div class="mdc-card info-card info-card--info">
            <div class="card-inner">
              <h5 class="card-title">Users</h5>
              <h5 class="font-weight-light pb-2 mb-1 border-bottom">200</h5>
              <p class="tx-12 text-muted"></p>
              <div class="card-icon-wrapper">
                <i class="material-icons">person</i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <ul class="nav nav-tabs">
          <li class="active">
            <a data-toggle="tab" class="mdc-button mdc-button--raised filled-button--secondary mdc-ripple-upgraded mr-1" href="#single">Single Licenses</a>
          </li>
          <li>
            <a data-toggle="tab" class="mdc-button mdc-button--raised mdc-ripple-upgraded" href="#group">Group Licenses</a>
          </li>
      </ul>
      
      <div class="tab-content">
        <div id="single" class="tab-pane fade in active">
          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card p-0">
              <h6 class="card-title card-padding pb-0">Users' License (Single) </h6>
              <div class="table-responsive">
                <table class="table table-hoverable">
                  <thead>
                    <tr>
                      <th class="text-left">Name</th>
                      <th>IMEI</th>
                      <th>License Key</th>
                      <th>Activation Date</th>
                      <th>Valid Till</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      
                    </tr>
                    <tr>
                      <td class="text-left">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      
                    </tr>
                    <tr>
                      <td class="text-left">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                     
                    </tr>
                    <tr>
                      <td class="text-left">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                     
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div id="group" class="tab-pane fade">
          <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
            <div class="mdc-card p-0">
              <h6 class="card-title card-padding pb-0">Users' License (Group) </h6>
              <div class="table-responsive">
                <table class="table table-hoverable">
                  <thead>
                    <tr>
                      <th class="text-left">Name</th>
                      <th>IMEI</th>
                      <th>License Key</th>
                      <th>Activation Date</th>
                      <th>Valid Till</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-left">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      
                    </tr>
                    <tr>
                      <td class="text-left">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      
                    </tr>
                    <tr>
                      <td class="text-left">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                     
                    </tr>
                    <tr>
                      <td class="text-left">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                     
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        
        </div>
    </div>
  </main>
  
@endsection
