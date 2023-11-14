@extends('dashboard.layouts.main')

@section('container')

<div class="row justify-content">
    <div class="col-lg-6">

        <div class="d-flex justify-content flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Participants</h1>
          </div>
          <a href="/dashboard/tournaments/{{ $tournament->slug }}/participants" class="btn btn-success mb-3">Back</a>
          <a href="/dashboard/tournaments" class="btn btn-success mb-3">Shuffle</a>

@if ($teams->count())
    

@foreach ($teams as $team )
    
          <form action="/dashboard/tournaments/{{ $tournament->slug }}/manage/{{ $team->id }}" method="post">
            @method('put')
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="name" class="form-control @error('name')is-invalid
              @enderror" id="name"  value="{{ $team->name }}">
              <button class="btn btn-primary" type="submit"><span data-feather="check"></span></button>
            </form>
              <form action="/dashboard/tournaments/{{ $tournament->slug }}/manage/{{ $team->id }}" method="post">
                @method('delete')
                @csrf
                <button class="btn btn-danger" type="submit"><span data-feather="x-circle"></span></button>
              </form>
            </div>
            @endforeach
            
    </div>

  



@endif

@endsection