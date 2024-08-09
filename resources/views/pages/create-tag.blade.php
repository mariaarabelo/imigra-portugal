@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p>Create Tag</p>
</div>

<div class="create-tag">
    <form method="POST" action="{{ route('admin.storeTag') }}">
        {{ csrf_field() }}

        <h2>Create Tag</h2>

        <label for="description">Description</label>
        <input id="description" type="text" name="description" value="{{ old('description') }}" required autofocus>
        @if ($errors->has('description'))
        <span class="error">
            {{ $errors->first('description') }}
        </span>
        @endif

        <button type="submit">
            Create
        </button>
        <a href="{{ route('admin.show') }}">
            Cancel
        </a>
    </form>
</div>

@endsection