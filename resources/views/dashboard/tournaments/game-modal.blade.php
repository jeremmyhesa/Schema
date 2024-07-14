<!-- Modal 1 -->
<div class="modal fade" id="modalGame" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Match</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form method="post" action="{{ route('store_match', ['tournament' => $tournament->slug]) }}">
            @csrf
            
            @foreach($games_1 as $game_1)  
            <div class="mb-3">
              <label for="homeTeam">{{ $game_1->homeTeam->name }}</label>
              <input type="text" name="homeTeam" id="homeTeam" class="form-control">
            </div>
            <div class="mb-3">
              <label for="awayTeam">{{ $game_1->awayTeam->name }}</label>
              <input type="text" name="awayTeam" id="awayTeam" class="form-control">
            </div>
            @endforeach
            <div class="d-flex justify-content-center">
              <h3>Verify the winner</h3>
            </div>
              <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
              
                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- End Modal 1 --}}
  <!-- Modal 2-->
<div class="modal fade" id="modalGame2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Match</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/tournaments/{{ $tournament->slug }}" method="post">
          @csrf
        <div class="mb-3">
          <label for="homeTeam">homeTeam</label>
          <input type="text" name="homeTeam" id="homeTeam" class="form-control">
        </div>
        <div class="mb-3">
          <label for="homeTeam">awayTeam</label>
          <input type="text" name="awayTeam" id="awayTeam" class="form-control">
        </div>
        <div class="d-flex justify-content-center">
          <h3>Verify the winner</h3>
        </div>
          <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
          
            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
{{-- End Modal 2--}}
<!-- Modal3 -->
<div class="modal fade" id="modalGame3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Match</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/tournaments/{{ $tournament->slug }}" method="post">
          @csrf
        <div class="mb-3">
          <label for="homeTeam">homeTeam</label>
          <input type="text" name="homeTeam" id="homeTeam" class="form-control">
        </div>
        <div class="mb-3">
          <label for="homeTeam">awayTeam</label>
          <input type="text" name="awayTeam" id="awayTeam" class="form-control">
        </div>
        <div class="d-flex justify-content-center">
          <h3>Verify the winner</h3>
        </div>
          <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
          
            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
{{-- End Modal3 --}}
<!-- Modal4 -->
<div class="modal fade" id="modalGame4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Match</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/tournaments/{{ $tournament->slug }}" method="post">
          @csrf
        <div class="mb-3">
          <label for="homeTeam">homeTeam</label>
          <input type="text" name="homeTeam" id="homeTeam" class="form-control">
        </div>
        <div class="mb-3">
          <label for="homeTeam">awayTeam</label>
          <input type="text" name="awayTeam" id="awayTeam" class="form-control">
        </div>
        <div class="d-flex justify-content-center">
          <h3>Verify the winner</h3>
        </div>
          <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
          
            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
{{-- End Modal4 --}}
<!-- Modal5 -->
<div class="modal fade" id="modalGame5" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Match</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/tournaments/{{ $tournament->slug }}" method="post">
          @csrf
        <div class="mb-3">
          <label for="homeTeam">homeTeam</label>
          <input type="text" name="homeTeam" id="homeTeam" class="form-control">
        </div>
        <div class="mb-3">
          <label for="homeTeam">awayTeam</label>
          <input type="text" name="awayTeam" id="awayTeam" class="form-control">
        </div>
        <div class="d-flex justify-content-center">
          <h3>Verify the winner</h3>
        </div>
          <div class="btn-group d-flex justify-content-center" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>
          
            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
{{-- End Modal5 --}}