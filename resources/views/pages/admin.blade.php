@extends('layouts.app')

@section('content')
<div id="breadcrumbs">
    <a href="\">Home</a>
    <p> > </p>
    <p>Admin Page</p>
</div>

@if(session('success'))
    <div style="color: #064B38;">{{ session('success') }}</div>
@endif

<div class="system-stats">
    <ul>
        <li>
            <span class="info-label">№ Users</span>
            <span class="info-value">{{ count($users) }}</span>
        </li>
        <li>
            <span class="info-label">№ Questions</span>
            <span class="info-value">{{ count($questions) }}</span>
        </li>
        <li>
            <span class="info-label">№ Answers</span>
            <span class="info-value">{{ count($answers) }}</span>
        </li>
        <li>
            <span class="info-label">№ Comments</span>
            <span class="info-value">{{ count($comments) }}</span>
        </li>
        <li>
            <span class="info-label">№ Tags</span>
            <span class="info-value">{{ count($tags) }}</span>
        </li>
    </ul>
</div>

<span id="users-header"> <h2>Users</h2> </span>
<div class="admin-user">
    <ul>
        <li> <a href="{{ route('admin.showUsers') }}">View Users</a> </li>
        <li> <a href="{{ route('admin.showCreateUser') }}">Create User</a> </li>
        <li> <a href="{{ route('admin.searchUser',  ['redirect' => 'Edit']) }}">Edit User</a> </li>
        <li> <a href="{{ route('admin.searchUser',  ['redirect' => 'Delete']) }}">Delete User</a> </li>
        <li> <a href="{{ route('admin.blockedUsers') }}">Blocked Users</a> </li>
    </ul>
</div>

<span id="tags-header"> <h2>Tags</h2> </span>
<div class="admin-tag">
    <ul>
        <li> <a href="{{ route('admin.showTags') }}">View Tags</a> </li>
        <li> <a href="{{ route('admin.showCreateTag') }}">Create Tag</a> </li>
        <li> <a href="{{ route('admin.searchTag',  ['redirect' => 'Edit']) }}">Edit Tag</a> </li>
        <li> <a href="{{ route('admin.searchTag',  ['redirect' => 'Delete']) }}">Delete Tag</a> </li>
    </ul>
</div>

@endsection