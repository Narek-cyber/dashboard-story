@extends('layouts.app')
@include('messages.message')
@section('content')
    <div class="container">
        @if(auth()->user() && auth()->user()->role == 'admin')
            <a
                href="{{ route('admin.stories.create') }}"
                class="btn btn-primary"
            >
                Add New Story
            </a>
        @endif
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
@section('script')
    <script type="module">
        // Pusher.logToConsole = true;
        let pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        });

        let channel = pusher.subscribe('approve-channel');
        channel.bind('approve-event', function (data) {
            const stories = data['stories'];
            let tableBody = $('#story-table-body');
            tableBody.empty();
            stories.forEach(function (story) {
                let row = `<tr>
                    <td>${story.title}</td>
                    <td>${story.description}</td>
                </tr>`;
                tableBody.append(row);
            });
        });
    </script>
@endsection
