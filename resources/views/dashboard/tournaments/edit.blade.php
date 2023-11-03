@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Tournament</h1>
  </div>

  <div class="col-lg-8">
  <form method="post" action="/dashboard/tournaments/{{ $tournament->slug }}" class="mb-5" enctype="multipart/form-data">
    @method('put')
    @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control @error('title')is-invalid @enderror" id="title" name="title" placeholder="Tournament title" 
    required autofocus value="{{ old('title', $tournament->title) }}">
    @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" class="form-control @error('slug')is-invalid @enderror" id="slug" name="slug" placeholder="tournament-title" 
    required value="{{ old('slug', $tournament->slug) }}">
    @error('slug')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Game</label>
    <div class="form-floating">
      <select class="form-select" name="category_id">
        @foreach ($categories as $category )

        @if (old('category_id') == $category->id)
        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
        @else
        <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endif

        @endforeach
      </select>
      <label for="floatingSelect">Game Category</label>
    </div>
  </div>
  <div class="mb-3">
    <label for="participants" class="form-label">Participants</label>
    <input type="string" class="form-control @error('participants')is-invalid @enderror" id="participants" name="participants" 
    required value="{{ old('participants', $tournament->participants) }}">
    @error('participants')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="image" class="form-label @error('image')is-invalid @enderror">Tournament Image</label>
    <input type="hidden" name="oldImage" value="{{ $tournament->image }}">
    @if($tournament->image)
      <img src="{{ asset('storage/' . $tournament->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
    @else
      <img class="img-preview img-fluid mb-3 col-sm-5">
    @endif
      <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
    @error('image')
      <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
    <div class="mb-3">
      <label for="date" class="form-label">Date</label>
      <input type="date" class="form-control @error('date')is-invalid @enderror" id="date" name="date" 
      required value="{{ old('date', $tournament->date) }}">
      @error('date')
      <div class="invalid-feedback">
        {{ $message }}
        @enderror
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Update Tournament</button>
  </form>
</div>

<script>
  const title = document.querySelector('#title');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function() {
    fetch('/dashboard/tournaments/checkSlug?title=' + title.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
  })

  function previewImage() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');
    
    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
      imgPreview.src = oFREvent.target.result;
    }
  }
</script>

@endsection