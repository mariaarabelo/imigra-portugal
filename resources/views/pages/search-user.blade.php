@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p> {{ $redirect }} User </p>
</div>

<div class="search-users">
    <h2>Search User</h2>
    <input type="text" id="searchInput" placeholder="Enter name or email">
    @if ($redirect == "Edit")
        <input type="hidden" id="link-redirect" name="link-redirect" value="/admin/edit/user/">
    @else
        <input type="hidden" id="link-redirect" name="link-redirect" value="/admin/delete/user/">
    @endif
    <button type="button" onclick="searchUsers()">
        Search
    </button>
    <button type="button" onclick="resetSearch()">
        Reset
    </button>

    <ul id="searchResults"></ul>
</div>


@endsection