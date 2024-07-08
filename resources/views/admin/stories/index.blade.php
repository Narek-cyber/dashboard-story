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
{{--@section('script')--}}
{{--    <script type="module">--}}
{{--        window.Echo.channel('approve-channel')--}}
{{--            .listen('.approve-event', (data) => {--}}
{{--                console.log('Order status updated: ', data);--}}
{{--                alert();--}}
{{--            });--}}
{{--    </script>--}}
{{--@endsection--}}
