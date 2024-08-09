@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p>Blocked Users</p>
</div>

@if(session('success'))
    <div style="color: #064B38;">{{ session('success') }}</div>
@endif

<div class="blocked-users">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.unblockUser', ['id' => $user->id]) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit">Unblock</button>
                        </form>
                    </td>
                </tr>
            @empty
                <p>No user blocked.</p>
            @endforelse
        </tbody>
    </table>
</div>

@endsection