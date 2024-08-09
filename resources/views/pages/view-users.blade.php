@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p>View Users</p>
</div>

@if(session('success'))
    <div style="color: #064B38;">{{ session('success') }}</div>
@endif

<div class="view-users">
    <input type="text" id="searchInput" placeholder="Enter name or email">
    <button type="button" onclick="filterUsers()">
        Search
    </button>
    <button type="button" onclick="resetUsers()">
        Reset
    </button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registration Date</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->regdate }}</td>
                    <td class="options-container">
                        <button class="options-button" onclick="toggleUserOptions({{ $user->id }})"> 
                            <span id="picture" title="Options"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </span>
                        </button>
                        <div class="options-list" id="optionsList-{{ $user->id }}">
                            <a href="{{ route('profile.show',  ['userId' => $user->id]) }}"> <i class="fa fa-user" aria-hidden="true"></i> View Profile </a>
                            <a href="{{ route('admin.editUser',  ['id' => $user->id ]) }}"> <i class="fa fa-magic" aria-hidden="true"></i> Edit User </a>
                            <a href="{{ route('admin.deleteUser',  ['id' => $user->id ]) }}"> <i class="fa fa-trash" aria-hidden="true"></i> Delete User </a>
                            <a href="#"> <i class="fa fa-bolt" aria-hidden="true"></i> Promote User </a>
                            <form method="POST" action="{{ route('admin.blockUser', ['id' => $user->id]) }}">
                                @csrf
                                @method('PUT')
                            <button type="submit"><i class="fa fa-user-times" aria-hidden="true"></i> Block User </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection