@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Story</h1>
        <form
            action="{{ route('admin.stories.store') }}"
            method="POST"
        >
            @csrf
            <div class="form-group">
                <label
                    for="title"
                >
                    Title
                </label>
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    id="title"
                >
                @error('title')
                    <span class="text-xs text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label
                    for="description"
                >
                    Description
                </label>
                <textarea
                    name="description"
                    class="form-control"
                    id="description"></textarea>
                @error('description')
                    <span class="text-xs text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <button
                type="submit"
                class="btn btn-primary mt-3"
            >
                Submit
            </button>
        </form>
    </div>
@endsection
