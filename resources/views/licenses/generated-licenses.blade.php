@extends('layouts.layout')

@section('content')
<!--Table-->
<div class="template-demo">
    <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
      <input type="hidden" name="enhanced-select">
      <i class="mdc-select__dropdown-icon"></i>
      <div class="mdc-select__selected-text"></div>
      <div class="mdc-select__menu mdc-menu-surface demo-width-class">
        <ul class="mdc-list">
          <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
          </li>
         <a href="{{ url('licenses/single-licenses') }}"><li class="mdc-list-item" data-value="grains">
            Single
          </li></a> 
          <a href="{{ url('licenses/group-licenses') }}"><li class="mdc-list-item" data-value="vegetables">
            Group
          </li></a>
          
        </ul>
      </div>
      <span class="mdc-floating-label">License Type</span>
      <div class="mdc-line-ripple"></div>
    </div>
  </div>
</br></br></br>

<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
<div class="mdc-card p-0">
  <h6 class="card-title card-padding pb-0">User Licence (Single) </h6>
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

@endsection
