@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p> {{ $redirect }} Tag </p>
</div>

<div class="search-tags">
    <h2>Search Tag</h2>
    <input type="text" id="searchInput" placeholder="Enter tag description">
    @if ($redirect == "Edit")
        <input type="hidden" id="link-redirect" name="link-redirect" value="/admin/edit/tag/">
    @else
        <input type="hidden" id="link-redirect" name="link-redirect" value="/admin/delete/tag/">
    @endif
    <button type="button" onclick="searchTags()">
        Search
    </button>
    <button type="button" onclick="resetSearch()">
        Reset
    </button>

    <ul id="searchResults"></ul>
</div>


@endsection