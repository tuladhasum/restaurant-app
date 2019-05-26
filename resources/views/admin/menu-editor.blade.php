@extends('layouts.app')
@section('title', ' - Menu Editor')
@section('content')
  <div class="container">


    <menu-editor :categories="{{$categories}}"></menu-editor>


  </div>
@endsection
