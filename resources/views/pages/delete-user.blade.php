@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p>Delete User</p>
</div>

<div class="delete-user">
    <form id="deleteForm" method="POST" action="{{ route('admin.destroyUser', ['id' => $user->id]) }}">
        @csrf
        @method('DELETE')

        <h2>Delete User</h2>

        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ $user->name }}" readonly>

        <label for="email">E-Mail</label>
        <input id="email" type="email" name="email" value="{{ $user->email }}" readonly>

        <label for="birthdate">Birth Date</label>
        <input id="birthdate" type="date" name="birthdate" value="{{ $user->birthdate ? date('Y-m-d', strtotime($user->birthdate)) : '' }}" readonly>

        <label for="points">Points</label>
        <input id="points" type="text" name="points" value="{{ $user->points }}" readonly>

        <button type="submit">
            Delete
        </button>
        <a href="{{ route('admin.show') }}">
            Cancel
        </a>
    </form>
</div>

@endsection