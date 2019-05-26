@extends('layouts.app')
@section('title', ' - Categories')
@section('content')
  <div class="container">

    <h1>Categories Manager</h1>

    <category-manager :initial-categories="{{$categories}}"></category-manager>


  </div>
@endsection
