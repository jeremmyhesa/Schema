@extends('dashboard.layouts.main')

@section('container')

<div class="row justify-content">
  <div class="col-md-6">
    <div class="d-flex justify-content flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Add Participants</h1>
    </div>

    @if(session()-> has('error'))
<div class="alert alert-danger col-md-8" role="alert">
    {{ session('error') }}
  </div>
@endif

@if ($teams->count())
  
<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">name</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($teams as $team )
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $team->name }}</td>
      <td>
                    <form action="/dashboard/tournaments/{{ $tournament->slug }}/participants/{{ $team->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0"><span data-feather="x-circle"></span></button>
                    </form>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>

<a href="/dashboard/tournaments/{{ $tournament->slug }}/manage" class="btn btn-success"><span class="mb-1" data-feather="folder"></span> Manage </a>
<a href="/dashboard/tournaments/{{ $tournament->slug }}" class="btn btn-success mx-3"><span class="mb-1" data-feather="folder"></span> Bracket </a>

  </div>
</div>

@else
  <p class="text-center fs-4">No team Found</p>

@endif

<div class="row justify-content">
  <div class="col-md-6">

    <main class="form-signin w-120 m-auto mt-3">  
      <form action="/dashboard/tournaments/{{ $tournament->slug }}/participants" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control @error('name')is-invalid
          @enderror" placeholder="Team Name" id="name" autofocus value="{{ old('name') }}">
          @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
          <button class="btn btn-primary" type="submit">Add</button>
        </div>
      </form>
          </div>


    </main>
  </div>


@endsection