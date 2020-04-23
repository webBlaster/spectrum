@extends('layouts.layout')

@section('content')

<main class="content-wrapper">
  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
      <div class="mdc-card">
          <div class="d-flex justify-content-between align-items-center">
              <div class="mdc-card">
                  <div class="template-demo">
                    @if($trash)
                        <thrashed-licenses></thrashed-licenses>
                    @else
                        <all-licenses></all-licenses>
                    @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection
