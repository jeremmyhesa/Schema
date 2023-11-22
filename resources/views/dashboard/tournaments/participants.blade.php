@extends('dashboard.layouts.main')

@section('container')

<div class="row justify-content">
  <div class="col-md-6">
    <div class="d-flex justify-content flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Add Participants</h1>
    </div>
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
      {{-- <td>
                    <form action="/dashboard/tournaments/{{ $tournament->slug }}/participants" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
      </td> --}}
    </tr>
    @endforeach
    
  </tbody>
</table>

<a href="/dashboard/tournaments/{{ $tournament->slug }}/manage" class="btn btn-success"><span class="mb-1" data-feather="folder"></span> Manage </a>

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
          <button class="btn btn-primary" type="submit">Add</button>
        </div>
      </form>
          </div>


    </main>
  </div>


@endsection