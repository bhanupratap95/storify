@extends('layouts.app')

@section('content')

  <section class="jumbotron text-center">
    <div class="container">
      <h1>HomePage</h1>
      <p class="lead text-muted">Great Stories From Our Author</p>
      <p>
        <a href="{{ route('dashboard.index') }}" class="btn btn-primary my-2">All</a>
        <a href="{{ route('dashboard.index', ['type' => 'short']) }}" class="btn btn-secondary my-2">Short</a>
        <a href="{{ route('dashboard.index', ['type' => 'long']) }}" class="btn btn-secondary my-2">Long</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        @foreach($stories as $story)
            <div class="col-md-4">
            <div class="card mb-4 shadow">
                <a href="{{ route('dashboard.show', [$story]) }}">
                    <img src="{{ $story->thumbnail }}" alt="image" width="100%"/>
                </a>
                <div class="card-body">
                <p class="card-text">{{ ($story->title) }}</a></p>
                @foreach( $story->tags as $tag )
                  <button class="btn btn-sm btn-outline-primary">{{ $tag->name }}</button>
                @endforeach
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Author: {{$story->user->name}}</button>
                    </div>
                    <small class="text-muted">Type: {{$story->type}}</small>
                </div>
                </div>
            </div>
            </div>
        @endforeach
      </div> <!-- End Row -->
      {{ $stories->withQueryString()->links() }}
    </div> <!-- End Container -->
  </div> <!-- End Album -->

@endsection

@section('styles')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection