@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $story->title }} by {{ $story->user->name }}

                    <a href="{{ route('dashboard.index') }}" class="float-right">Back</a>
                </div>

                <div class="card-body">
                <img src="{{ $story->thumbnail }}" alt="image" width="100%"/>
                    <!-- {{  $story->body }}

                    <p class="font-italic">{{ $story->footnote }}</p> -->
                    <br/>
                    <br/>
                    <p class="card-text">{{ ($story->body) }}</a></p>
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
    </div>
</div>
@endsection