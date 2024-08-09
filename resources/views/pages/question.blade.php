@extends('layouts.app')

@section('content')
    <div id="breadcrumbs">
        <a href="\">Home</a>
        <p> > </p>
        <p>{{ $tag->description }}</p>
    </div>

    <div id="viewQA">
        <div class="questions">
            @forelse ($questions as $question)
                @include('partials.question', ['question' => $question, 'tag' => $tag])
            @empty
                <p>No questions available.</p>
            @endforelse
        </div>

        @if (!$questions->isEmpty())
            <div class="answer">
                <h2>Answers</h2>
                <ul id="answerList">
                    {{-- Aqui será inserida a lista de respostas --}}
                </ul>
                @if (Auth::check())
                    <div class="typeMessage">
                        <form id="sendAnswer" method="post">
                            @csrf
                            <input type="hidden" id="question_id" name="question_id" value="{{ $question->idcontent }}">
                            <input type="hidden" id="tag_id" name="tag_id" value="{{ $tag->id }}">
                            <input type="text" id="answer-description" name="description" placeholder="Write your answer...">
                            <button type="submit" id="sendAnswerButton">
                                <span id="picture" title="Send Answer"> <i class="fa fa-paper-plane" aria-hidden="true"></i> </span>
                            </button>
                        </form>
                    </div>
                @endif

                {{-- Formulários --}}
                @foreach ($questions as $question)
                    @foreach ($question->answers as $answer)
                        @include('partials.answer', ['answer' => $answer, 'question' => $question, 'tag' => $tag])
                    @endforeach
                @endforeach
            </div>
        @endif
    </div>

    @if (Auth::check())
        <div id="writeQuestion">
            <a class="button" href="{{ route('questions.create', ['idTag' => $tag->id]) }}">
                <span id="picture" title="Add Question"> <i class="fa fa-plus" aria-hidden="true"></i>  </span>
            </a>
        </div>
    @endif
@endsection