@extends('layouts.app')

@section('content')

<div id="breadcrumbs">
    <a href="/">Home</a>
    <p> > </p>
    <a href="{{ route('admin.show') }}">Admin Page</a>
    <p> > </p>
    <p>View Tags</p>
</div>

<div class="view-tags">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->description }}</td>
                    <td>
                        <a href="{{ route('admin.editTag',  ['id' => $tag->id ]) }}"> <i class="fa fa-magic" aria-hidden="true"></i> Edit Tag </a>
                        <span id="delete-icon">
                            <a href="{{ route('admin.deleteTag',  ['id' => $tag->id ]) }}"> <i class="fa fa-trash" aria-hidden="true"></i> Delete Tag </a>
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection