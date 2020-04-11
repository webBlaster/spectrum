@extends('layouts.app')

@section('content')
   @if($accessKey)
      <print-key mykey="{{$accessKey}}"></print-key>
   @endif
@endsection