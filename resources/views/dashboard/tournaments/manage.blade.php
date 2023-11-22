@extends('dashboard.layouts.main')

@section('container')

<div class="row-lg-8">
    <div class="col-lg-6">

        <div class="d-flex justify-content flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Participants</h1>
          </div>
          <form action="/dashboard/tournaments/{{ $tournament->slug }}/manage" method="post" class="d-inline my-2">
            @method('put')
            @csrf
            <button class="btn btn-primary mb-3" type="submit">Shuffle</button>
        </form>
          <form action="/dashboard/tournaments/{{ $tournament->slug }}/manage" method="post">
            @csrf
            <button class="btn btn-primary mb-3 " type="submit">Save</button>
          </form>
          {{-- <a href="dashboard/tournaments/{{ $tournament->slug }}/participants" class="btn btn-success mb-3 mx-3">Save</a> --}}

@if ($teams->count())
    

@foreach ($teams as $team )
    
          <form action="/dashboard/tournaments/{{ $tournament->slug }}/manage/{{ $team->id }}" method="post">
            @method('put')
            @csrf
            <div class="input-group mb-0">
              <input type="text" name="name" class="form-control @error('name')is-invalid
              @enderror" id="name"  value="{{ $team->name }}">
              <button class="btn btn-primary" type="submit"><span data-feather="check"></span></button>
            </form>
            
            <form action="/dashboard/tournaments/{{ $tournament->slug }}/manage/{{ $team->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="btn btn-danger" type="submit"><span data-feather="x-circle"></span></button>
            </form>
            </div>  
              @endforeach
            </div>
            
    </div>

  



@endif

@endsection