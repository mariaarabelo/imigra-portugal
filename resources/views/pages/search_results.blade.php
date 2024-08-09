@extends('layouts.app')

@section('content')

<div class="search-results">
    <h1>Search Results for "{{ $query }}"</h1>
    <p class="result-count">Number of results: {{ $questions->count() }}</p>
    @if($questions->count() > 0)
        <div class="list-wrapper">
            <ul class="result-list">
                @foreach($questions as $question)
                    <li class="result-item">
                        @if(isset($question->title))
                            <a href="{{ route('questions.byTag', ['idTag' => $question->content->contenttags->idtag]) }}">{{ $question->title }}</a>
                        @else
                            <p class="invalid-data"> Invalid question data </p>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <p class="no-results">No results found.</p>
    @endif
</div>

@endsection