@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Notice Board</h1>
        <div id="stories">
            @foreach ($stories as $story)
                <div class="story">
                    <h2>{{ $story->title }}</h2>
                    <p>{!! $story->description !!}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
