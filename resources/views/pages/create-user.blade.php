@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p>Create User</p>
</div>

<div class="create-user">
    <form method="POST" action="{{ route('admin.storeUser') }}">
        {{ csrf_field() }}

        <h2>Create User</h2>

        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        @if ($errors->has('name'))
        <span class="error">
            {{ $errors->first('name') }}
        </span>
        @endif

        <label for="email">E-Mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
        <span class="error">
            {{ $errors->first('email') }}
        </span>
        @endif

        <label for="birthdate">Birth Date</label>
        <input id="birthdate" type="date" name="birthdate" value="{{ old('birthdate') }}" required>
        @if ($errors->has('birthdate'))
        <span class="error">
            {{ $errors->first('birthdate') }}
        </span>
        @endif

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
        @endif

        <label for="password-confirm">Confirm Password</label>
        <input id="password-confirm" type="password" name="password_confirmation" required>

        <button type="submit">
            Create
        </button>
        <a href="{{ route('admin.show') }}">
            Cancel
        </a>
    </form>
</div>

@endsection