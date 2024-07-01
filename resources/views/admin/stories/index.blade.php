@extends('layouts.app')
@include('messages.message')
@section('content')
    <div class="container">
        <a
            href="{{ route('admin.stories.create') }}"
            class="btn btn-primary"
        >
            Add New Story
        </a>
        <table class="table mt-4">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody id="story-table-body">
                @if(!empty($stories))
                    @foreach ($stories as $story)
                        <tr>
                            <td>{{ $story->title }}</td>
                            <td>{{ $story->description }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
