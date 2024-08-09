@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p>Delete Tag</p>
</div>

<div class="delete-tag">
    <form id="deleteForm" method="POST" action="{{ route('admin.destroyTag', ['id' => $tag->id]) }}">
        @csrf
        @method('DELETE')

        <h2>Delete Tag</h2>

        <label for="description">Description</label>
        <input id="description" type="text" name="description" value="{{ $tag->description }}" readonly>

        <button type="submit">
            Delete
        </button>
        <a href="{{ route('admin.show') }}">
            Cancel
        </a>
    </form>
</div>

@endsection