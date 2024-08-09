@extends('layouts.app')

@section('content')

<div class="search-bar">
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name= "query" placeholder="Search...">
        <button type="submit">find</button>
    </form>
</div>

<div id="tags"> 
    <ul>
        @if(isset($tags))
            @foreach($tags as $tag)
                <li class="tag"><a class="link" href="{{ route('questions.byTag', ['idTag' => $tag->id]) }}">{{ $tag->description }}</a></li>
            @endforeach
        @endif

        @if($hasMoreTags)
            <li class="tag more-tags"><a class="link" href="#" onclick="toggleTags(event)">Others</a></li>
            <!-- Adiciona outras tags abaixo (ocultas inicialmente) -->
            @foreach($additionalTags as $tag)
                <li class="tag additional-tag" style="display: none;"><a class="link" href="{{ route('questions.byTag', ['idTag' => $tag->id]) }}">{{ $tag->description }}</a></li>
            @endforeach
        @endif
    </ul>
</div>
@endsection