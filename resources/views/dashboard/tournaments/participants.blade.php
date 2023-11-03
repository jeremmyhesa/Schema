@extends('dashboard.layouts.main')

@section('container')

<div class="row justify-content">
  <div class="col-md-6">
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
        <a href="/dashboard/tournaments/{{ $tournament->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/tournaments/{{ $tournament->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
      </td> --}}
    </tr>
    @endforeach
    
  </tbody>
</table>
  </div>
</div>

@else
  <p class="text-center fs-4">No team Found</p>

@endif

<div class="row justify-content">
  <div class="col-md-6">

    <main class="form-signin w-120 m-auto">
        <div class="d-flex justify-content flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Add Participants</h1>
          </div>
      <form action="/dashboard/tournaments/participants" method="POST">
        @csrf
        
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control @error('name')is-invalid
          @enderror" placeholder="Team Name" id="name" required value="{{ old('name') }}">
          <button class="btn btn-primary" type="submit">Add</button>
        </div>

        {{-- <div class="form-floating">
          <input type="text" name="name" class="form-control rounded-top @error('name')is-invalid
          @enderror"
          id="name" placeholder="Team name" required value="{{ old('name') }}">
          <label for="name">Team name</label>
          <div class="mt-2">
              <button class="w-20 btn btn-lg btn-primary" type="submit">Add</button>
          </div>         
        </div> --}}
          </div>
      </form>


    </main>
  </div>


@endsection