@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">About</h1>
</div>

<body>
<h3>{{$users[0]->name}}</h3>
<p>{{$users[0]->email}}</p>
<img src="/img/user.png" alt={{$users[0]->name}} width="200" class="img-thumbnail rounded-circle">
</div>

@endsection

