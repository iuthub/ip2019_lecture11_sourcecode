@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h1 class="display-4">My Laravel Blog</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
</div>
<hr>
<div class="row">
    <div class="col">
        <div class="card-columns">
            @foreach($posts as $post)
	                 <div class="card">
	                	<h5 class="card-header">{{ $post->title }}</h5>
		                <div class="card-body">
		                    <p class="card-text">{{ $post->body }}</p>
		                </div>
	                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection