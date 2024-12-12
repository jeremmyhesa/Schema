<!-- Modal 1 -->

<div class="modal fade" id="modalGame" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Game Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="gameForm" method="post" action="">
          @csrf

          <input type="hidden" name="tournament_id" value="{{ $tournament->id ?? '' }}">
          <input type="hidden" id="roundIdInput" name="round_id" value="">
          <input type="hidden" id="HTidInput" name="home_team_id" value="">
          <input type="hidden" id="ATIdInput" name="away_team_id" value="">
          <input type="hidden" id="gameIdInput" name="game_id" value="">

          {{-- Error message --}}
          <div id="formErrorMessage" class="alert alert-danger d-none"></div>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">Participants</th>
                <th scope="col">Score</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th><label id="homeTeamLabel" for="homeTeam"></label></th>
                <td><input type="number" name="home_team_score" id="homeTeamScore" class="form-control-mini"
                  min="0" aria-labelledby="homeTeamLabel" placeholder=""></td>
              </tr>

              <tr>
                <th><label id="awayTeamLabel" for="awayTeam"></label></th>
                <td><input type="number" name="away_team_score" id="awayTeamScore" class="form-control-mini" 
                  min="0" aria-labelledby="awayTeamLabel" placeholder=""></td>
              </tr>
            </tbody>
          </table>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">
              Submit
              <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('gameForm');
  const submitBtn = document.getElementById('submitBtn');
  const loadingSpinner = document.getElementById('loadingSpinner');
  const homeScore = document.getElementById('homeTeamScore');
  const awayScore = document.getElementById('awayTeamScore');
  const formErrorMessage = document.getElementById('formErrorMessage');

  document.getElementById('modalGame').addEventListener('shown.bs.modal', function(){
    homeScore.focus();
  })

  form.addEventListener('submit', function (event) {
      if (homeScore.value < 0 || awayScore.value < 0) {
          event.preventDefault();
          formErrorMessage.textContent = 'Scores must be non-negative integers.';
          formErrorMessage.classList.remove('d-none');
          return;
      }

      // Confirmation
      const confirmed = confirm(`Are you sure you want to submit the scores?\n\nHome Team: ${homeScore.value}\nAway Team: ${awayScore.value}`);
      if (!confirmed) {
        event.preventDefault();
        return;
      }

      // Hide error message
      formErrorMessage.classList.add('d-none');

      loadingSpinner.classList.remove('d-none');
      submitBtn.disabled = true;
  });
  
  // Server-side error handling
  @if(session('error'))
      formErrorMessage.textContent = '{{ session('error') }}';
      formErrorMessage.classList.remove('d-none');
  @endif
});
</script>
