@extends('layouts.app')

@section('content')
    <div id="breadcrumbs">
        <a href="\">Home</a>
        <p> > </p>
        <a href="{{ route('questions.byTag', ['idTag' => $selectedTag->id]) }}"> {{ $selectedTag->description }} </a>
        <p> > </p>
        <p> New Question </p>
    </div>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <div id="writing_question">
        <form id="writingQuestionForm" action="{{ route('questions.store') }}" method="POST">
            <h2>New Question</h2>
            @csrf
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <br>

            <label for="content">Content:</label>
            <textarea name="content" id="content" required></textarea>
            <br>

            <label for="tag">Select Tag:</label>
            <select name="tag" id="tag" required>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @if ($tag->id == $selectedTag->id) selected @endif>{{ $tag->description }}</option>
                @endforeach
            </select>
            <br>

            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
