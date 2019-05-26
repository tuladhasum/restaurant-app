@extends('layouts.app')

@section('content')
  <div class="container">

    <div class="menu-categories">
      @foreach($categories as $category)
        <article>
          <a href="#/{{\Illuminate\Support\Str::slug($category->name)}}">
            <img src="/images/{{$category->image}}"></a>
          <h2><a href="/images/{{$category->image}}">{{$category->name}}</a></h2>
        </article>
      @endforeach
    </div>

  </div>
@endsection
