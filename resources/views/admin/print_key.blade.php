@extends('layouts.app')

@section('content')
   @if($key)
      <print-key incoming_key="{{$key}}"></print-key>
   @endif
@endsection