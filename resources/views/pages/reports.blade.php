@extends('layouts.app')

@section('content')
<div id="breadcrumbs">
    <a href="\">Home</a>
    <p> > </p>
    <p> Moderator </p>
</div>

<h2 id="moderator-header">Moderator Reports</h2>

<div class="moderator-reports">
    @if ($reports->count() > 0)
        <div class="report">
            @foreach ($reports as $report)
                <li>
                    <ul>
                        <li>Report Description: {{ $report->description }}</li>    
                        @if ($report->content)
                            <li>Content ID: {{ $report->content->id }} 
                                <button onclick="deleteContent({{ $report->content->id }})"> Delete Content</button> 
                            </li>
                            <li>Content Description: {{ $report->content->description }}</li>
                        @endif
                        <li>Report Date: {{ $report->reportdate }}</li>
                        <li>Status: {{ $report->status ? 'Resolved' : 'Unresolved' }}
                            @if ($report->status)
                                <i class="fas fa-check"></i>
                            @endif
                        </li>
                    </ul>
                </li>
            @endforeach
        </div>
    @else
        <p>No reports available for the moderator.</p>
    @endif
</div>

<span id="tags-header"> <h2>Tags</h2> </span>
<div class="moderator-tag">
    <ul>
        <li> <a href="{{ route('moderator.showTags') }}">View Tags</a> </li>
        <li> <a href="{{ route('moderator.showCreateTag') }}">Create Tag</a> </li>
        <li> <a href="{{ route('moderator.searchTag',  ['redirect' => 'Edit']) }}">Edit Tag</a> </li>
        <li> <a href="{{ route('moderator.searchTag',  ['redirect' => 'Delete']) }}">Delete Tag</a> </li>
    </ul>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@endsection