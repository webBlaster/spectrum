@extends('layouts.layout')

@section('content')
  <main class="content-wrapper">
 
    <div class="mdc-layout-grid">
      <div class="mdc-layout-grid__inner">
        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
          <div class="mdc-card info-card info-card--success">
            <div class="card-inner">
              <h5 class="card-title">Granted Licenses</h5>
              <h5 class="font-weight-light pb-2 mb-1 border-bottom">{{$user->count_users_with_license()}}</h5>
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
              <h5 class="font-weight-light pb-2 mb-1 border-bottom">{{$user->count_users_with_license()}}</h5>
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
              <h5 class="font-weight-light pb-2 mb-1 border-bottom">{{$book->book_count()}}</h5>
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
              <h5 class="font-weight-light pb-2 mb-1 border-bottom">{{$user->users_count()}}</h5>
              <p class="tx-12 text-muted"></p>
              <div class="card-icon-wrapper">
                <i class="material-icons">person</i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <dashboard-licenses></dashboard-licenses>
  </main>
  
@endsection

