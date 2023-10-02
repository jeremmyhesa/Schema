@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Welcome Back, {{ auth()->user()->name }}</h1>
  </div>



  {{-- <div class="row justify-content-center mb-3">
    <div class="col-md-6">
      <form action="/dashboard/index">
        @if (request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        @if (request('organizer'))
          <input type="hidden" name="organizer" value="{{ request('organizer') }}">
        @endif
      </form>
    </div>
  </div> --}}
  
  @if ($tournaments->count())
    <div class="card mb-3">
      @if ($tournaments[0]->image)
        <div style="max-height: 400px; overflow:hidden;">
        <img src="{{ asset('storage/' . $tournaments[0]->image) }}" alt="{{ $tournaments[0]->category->name }}" 
        class="image-fluid mt-3">
        </div>
        @else  
        <img src="https://source.unsplash.com/1200x400?{{ $tournaments[0]->category->name }}" 
        class="card-img-top" alt="{{ $tournaments[0]->category->name }}">
        @endif
      
      <div class="card-body text-center">
        <h3 class="card-title"><a href="/dashboard/index/{{ $tournaments[0]->slug }}" 
          class="text-decoration-none text-dark">{{ $tournaments[0]->title }}</a></h3>
        <p class="card-text">{{ $tournaments[0]->date }}</p>
        <small class="texx-muted">
          <p>By, <a href="/dashboard/index?organizer={{ $tournaments[0]->organizer->username }}" 
            class="text-decoration-none">{{ $tournaments[0]->organizer->name }}</a> in 
            <a href="/dashboard/index?category={{ $tournaments[0]->category->slug }}" 
              class="text-decoration-none">{{ $tournaments[0]->category->name }}
            </a> {{ $tournaments[0]->created_at->diffForHumans()}}</small></p>
            <p class="card-text">{{ $tournaments[0]->participants }}</p>
  
            <a href="/dashboard/index/{{ $tournaments[0]->slug }}" class="text-decoration-none btn btn-primary">Detail</a>
  
      </div>
    </div>
  
  
  <div class="container">
    <div class="row">
      @foreach ($tournaments->skip(1) as $tournament)
      <div class="col-md-4 mb-3">
        <div class="card">
          <div class="position-absolute px-3 py-2" style="background-color: rgba(0,0,0,0.5)">
            <a href="/dashboard/index?category={{ $tournament->category->slug }}" 
              class="text-white text-decoration-none">{{ $tournament->category->name }} </a></div>
              @if ($tournament->image)
          <img src="{{ asset('storage/' . $tournament->image) }}" alt="{{ $tournament->category->name }}" 
          class="image-fluid">
        @else  
        <img src="https://source.unsplash.com/500x400?{{ $tournament->category->name }}" 
          class="card-img-top" alt="{{ $tournament->category->name }}">
        @endif
          
          <div class="card-body">
            <h5 class="card-title">{{ $tournament->title}}</h5>
            <small class="texx-muted">
              <p>By, <a href="/dashboard/index?organizer={{ $tournament->organizer->username }}" 
                class="text-decoration-none">{{ $tournament->organizer->name }}</a> 
                </a> {{ $tournament->created_at->diffForHumans()}}</small></p>
            <p class="card-text">{{ $tournament->date }}</p>
            <p class="card-text">{{ $tournament->participants }}</p>
            <a href="/dashboard/index/{{ $tournament->slug }}" class="text-decoration-none btn btn-primary">Detail</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif
  
   


  
@endsection