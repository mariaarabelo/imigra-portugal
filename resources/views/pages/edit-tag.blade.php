@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p>Edit Tag</p>
</div>

<div class="edit-tag">
    <form method="POST" action="{{ route('admin.updateTag', ['id' => $tag->id]) }}">
        @csrf
        @method('PUT')

        <h2>Edit Tag</h2>

        <label for="description">Description</label>
        <input id="description" type="text" name="description" value="{{ $tag->description }}" required autofocus>
        @if ($errors->has('description'))
        <span class="error">
            {{ $errors->first('description') }}
        </span>
        @endif

        <button type="submit">
            Update
        </button>
        <a href="{{ route('admin.show') }}">
            Cancel
        </a>
    </form>
</div>

@endsection