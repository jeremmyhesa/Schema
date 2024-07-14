@extends('dashboard.layouts.main')
<link rel="stylesheet" href="/css/gaya.css">
@section('container')

<div class="container">
    <div class="row my-3">
      <div class="col-lg-8">
      <h1 class="mb-3">{{ $tournament->title }}</h1>
      
        <a href="/dashboard/tournaments" class="btn btn-success"><span data-feather="arrow-left"></span> Back to my tournaments</a>
        <a href="/dashboard/tournaments/{{ $tournament->slug }}/edit" class="btn btn-warning text-white">
          <span data-feather="edit"></span> Edit</a>
        <form action="/dashboard/tournaments/{{ $tournament->slug }}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
          <a href="/dashboard/tournaments/{{ $tournament->slug }}/participants" class="btn btn-danger">Add Participants</a>
          </form>

        
      @if ($tournament->image)
      <div style="max-height: 350px; overflow:hidden;">
        <img src="{{ asset('storage/' . $tournament->image) }}" alt="{{ $tournament->category->name }}" 
        class="image-fluid mt-3">
      </div>
      @else  
      <img src="/img/turnamen.jpg" alt="Turnamen" 
      class="image-fluid mt-3">
      @endif
      <h5>{{ $tournament->date }}</h5>
      <h5>{{ $tournament->participants }}</h5>
    
    </div>
    </div>

    @if(session()-> has('success'))
      <div class="alert alert-success col-lg-8" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="bg-dark">
    <div class="top d-flex flex-row mb-3 bg-white">
      @foreach ($rounds as $round )
        <div class="first p-2"><span class="first-round">{{ $round->name }}</span></div>
      @endforeach
    </div>

    
      <main id='tournament' class="bracket mb-3">

        <ul class='round round-1'>
          @forelse ($games_1 as $game_1 )
            <div class="game game-top d-inline-flex p-2"><span class="name">{{ $game_1->homeTeam->name ?? ''}}</span></div>
            <div class="game game-bottom d-inline-flex p-2"><span class="name">{{ $game_1->awayTeam->name ?? ''}}</span></div>
            <li class='spacer'>&nbsp;</li>
        
          @empty
          @for ($i = 0; $i < 16; $i++)
            <div class="game game-top d-inline-flex p-2"><span class="name"></span></div>
            <div class="game game-bottom d-inline-flex p-2"><span class="name"></span></div>
            <li class='spacer'>&nbsp;</li>
          @endfor
          @endforelse
        </ul>
          <ul class="right-spacer">
            @for ($i = 1; $i <= 8; $i++ )
              <div class="line-space d-inline flex p-2"></div>
              <br>
            @endfor
          </ul>
          <ul class="strip">
            @for ($i = 1; $i <= 8; $i++)
              <div class="line d-inline flex p-2"></div>
            @endfor
          </ul>
          <ul class="button-1">
            @forelse ($games_1 as $game_1 ) 
            <button type="button" class="play-1 text-white" data-bs-toggle="modal" data-bs-target="#modalGame"><span data-feather="play"></span>
            </button>
            @empty
            @for ($i = 0; $i < 16; $i++)
              <a href="#" class="no-play-1"><span data-feather="play"></span></a>
              <br>
            @endfor
            @endforelse
          </ul>
          {{-- @endif --}}
            {{-- # --}}

          {{-- Round-2 --}}
          <ul class='round round-2'>
            @forelse ($games_2 as $game_2 )
              <div class="game-2 game-top-2 d-inline-flex p-2"><span class="name">{{ $game_2->homeTeam->name ?? ''}}</span></div>
              <div class="game-2 game-bottom-2 d-inline-flex p-2"><span class="name">{{ $game_2->awayTeam->name ?? ''}}</span></div>
              <li class='spacer-2'>&nbsp;</li>
            @empty
            @for ($i = 0; $i < 8; $i++)
              <div class="game-2 game-top-2 d-inline-flex p-2"><span class="name"></span></div>
              <div class="game-2 game-bottom-2 d-inline-flex p-2"><span class="name"></span></div>
              <li class='spacer-2'>&nbsp;</li>
            @endfor
            @endforelse
          </ul>
            <ul class="right-spacer-2">
              @for ($i = 1; $i <= 4; $i++ )
                <div class="line-space-2 d-inline flex p-2"></div>
                <br>
              @endfor
            </ul>
            <ul class="strip-2">
              @for ($i = 1; $i <= 4; $i++)
                <div class="line-2 d-inline flex p-2"></div>
              @endfor
            </ul>
            <ul class="button-2">
              @forelse ($games_2 as $game_2 ) 
              <button type="button" class="play-2 text-white" data-bs-toggle="modal" data-bs-target="#modalGame2"><span data-feather="play"></span>
              </button>
              @empty
              @for ($i = 0; $i < 8; $i++)
                <a href="#" class="no-play-2 text-white"><span data-feather="play"></span></a>
                <br>
              @endfor
              @endforelse
            </ul>
          {{-- #2 --}}

          {{-- Round-3 --}}
          <ul class='round round-3'>
            @forelse ($games_3 as $game_3 )
              <div class="game-3 game-top-3 d-inline-flex p-2"><span class="name">{{ $game_3->homeTeam->name ?? ''}}</span></div>
              <div class="game-3 game-bottom-3 d-inline-flex p-2"><span class="name">{{ $game_3->awayTeam->name ?? ''}}</span></div>
              <li class='spacer-3'>&nbsp;</li>
            @empty
            @for ($i = 0; $i < 4; $i++)
              <div class="game-3 game-top-3 d-inline-flex p-2"><span class="name"></span></div>
              <div class="game-3 game-bottom-3 d-inline-flex p-2"><span class="name"></span></div>
              <li class='spacer-3'>&nbsp;</li>
            @endfor
            @endforelse
          </ul>
          <ul class="right-spacer-3">
            @for ($i = 1; $i <= 2; $i++ )
              <div class="line-space-3 d-inline flex p-2"></div>
              <br>
            @endfor
          </ul>
          <ul class="strip-3">
            @for ($i = 1; $i <= 2; $i++)
              <div class="line-3 d-inline flex p-2"></div>
            @endfor
          </ul>
          <ul class="button-3">
            @forelse ($games_3 as $game_3 ) 
            <button type="button" class="play-3 text-white" data-bs-toggle="modal" data-bs-target="#modalGame3"><span data-feather="play"></span>
            </button>
            @empty
            @for ($i = 0; $i < 4; $i++)
              <a href="#" class="no-play-3 text-white"><span data-feather="play"></span></a>
              <br>
            @endfor
            @endforelse
          </ul>
          {{-- #3 --}}

          {{-- Semi Final --}}
          <ul class='round round-4'>
            @forelse ($games_4 as $game_4 )
              <div class="game-4 game-top-4 d-inline-flex p-2"><span class="name">{{ $game_4->homeTeam->name ?? ''}}</span></div>
              <div class="game-4 game-bottom-4 d-inline-flex p-2"><span class="name">{{ $game_4->awayTeam->name ?? ''}}</span></div>
              <li class='spacer-4'>&nbsp;</li>
            @empty
            @for ($i = 0; $i < 2; $i++)
              <div class="game-4 game-top-4 d-inline-flex p-2"><span class="name"></span></div>
              <div class="game-4 game-bottom-4 d-inline-flex p-2"><span class="name"></span></div>
              <li class='spacer-4'>&nbsp;</li>
            @endfor
            @endforelse
          </ul>
          <ul class="right-spacer-4">
            <div class="line-space-4 d-inline flex p-2"></div>
          </ul>
          <ul class="strip-4">
            <div class="line-4 d-inline flex p-2"></div>
          </ul>
          <ul class="button-4">
            @forelse ($games_4 as $game_4 ) 
            <button type="button" class="play-4 text-white" data-bs-toggle="modal" data-bs-target="#modalGame4"><span data-feather="play"></span>
            </button>
            @empty
            @for ($i = 0; $i < 2; $i++)
              <a href="#" class="no-play-4 text-white"><span data-feather="play"></span></a>
              <br>
            @endfor
            @endforelse
          </ul>
          {{-- #Semi Final --}}

          {{-- Final --}}
          <ul class='round round-5'>
            @forelse ($finals as $final )
              <div class="game-5 game-top-5 d-inline-flex p-2"><span class="name">{{ $final->homeTeam->name ?? ''}}</span></div>
              <div class="game-5 game-bottom-5 d-inline-flex p-2"><span class="name">{{ $final->awayTeam->name ?? ''}}</span></div>
            @empty
            @for ($i = 0; $i < 1; $i++)
              <div class="game-5 game-top-5 d-inline-flex p-2"><span class="name"></span></div>
              <div class="game-5 game-bottom-5 d-inline-flex p-2"><span class="name"></span></div>
            @endfor
            @endforelse
          </ul>
          <ul class="strip-5">
            <div class="line-5 d-inline flex p-2"></div>
          </ul>
          <ul class="button-5">
            @forelse ($finals as $final ) 
            <button type="button" class="play-5 text-white" data-bs-toggle="modal" data-bs-target="#modalGame5"><span data-feather="play"></span>
            </button>
            @empty
            <a href="#" class="no-play-5 text-white"><span data-feather="play"></span></a>
            @endforelse
          </ul>
          {{-- #Final --}}

          {{-- Winner --}}
          <ul class='round round-6'>
            <div class="winner d-inline-flex p-2"><span class="name">Winner</span></div>
            <div class="game-6 game-top-6 d-inline-flex p-2"><span class="name">{{ $final->homeTeam->name ?? ''}}</span></div>
          </ul>
      </main>
      </div>
  </div>
  
  <!-- Modal -->
  @include('dashboard.tournaments.game-modal', [
    'games_1' => $games_1,
    'games_2' => $games_2,
    'games_3' => $games_3,
    'games_4' => $games_4,
    'finals'  => $finals
])
{{-- End Modal --}}
  
@endsection