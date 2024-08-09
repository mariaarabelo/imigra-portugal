@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p>Edit User</p>
</div>

<div class="edit-user">
    <form method="POST" action="{{ route('admin.updateUser', ['id' => $user->id]) }}">
        @csrf
        @method('PUT')

        <h2>Edit User</h2>

        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ $user->name }}" required autofocus>
        @if ($errors->has('name'))
        <span class="error">
            {{ $errors->first('name') }}
        </span>
        @endif

        <label for="email">E-Mail</label>
        <input id="email" type="email" name="email" value="{{ $user->email }}" required>
        @if ($errors->has('email'))
        <span class="error">
            {{ $errors->first('email') }}
        </span>
        @endif

        <label for="birthdate">Birth Date</label>
        <input id="birthdate" type="date" name="birthdate" value="{{ $user->birthdate ? date('Y-m-d', strtotime($user->birthdate)) : '' }}" required>
        @if ($errors->has('birthdate'))
        <span class="error">
            {{ $errors->first('birthdate') }}
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