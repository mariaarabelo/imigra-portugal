{{-- Delete Answer form (hidden) --}}
<form id="delete-answer-form-{{ $answer->idcontent }}" action="{{ route('answers.destroy', ['id' => $answer->idcontent, 'idTag' => $tag->id]) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

{{-- Edit Answer form (initially hidden) --}}
<form id="edit-answer-form-{{ $answer->idcontent }}" class="edit-answer-form" style="display: none;" method="post">
    @csrf
    @method('PUT')
    <textarea name="edited_content" id="edited-content-{{ $answer->idcontent }}">{{ $answer->content->description }}</textarea>
    <input type="hidden" id="question_id" name="question_id" value="{{ $question->idcontent }}">
    <input type="hidden" id="tag_id" name="tag_id" value="{{ $tag->id }}">
    <button type="button" id="editAnswerButton" onclick="editAnswers('{{ $answer->idcontent }}', '{{ $question->idcontent }}')">Save</button>
    <button type="button" id="editAnswerButton" onclick="cancelEditAnswer('{{ $answer->idcontent }}')">Cancel</button>
</form>

@foreach ($answer->comments as $comment)
    {{-- Delete Comment form (hidden) --}}
    <form id="delete-comment-form-{{ $comment->idcontent }}" action="{{ route('comments.destroy', ['id' => $comment->idcontent, 'idTag' => $tag->id]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    {{-- Edit Comment form (initially hidden) --}}
    <form id="edit-comment-form-{{ $comment->idcontent }}" class="edit-comment-form" style="display: none;" method="post">
        @csrf
        @method('PUT')
        <textarea name="edited_content" id="edited-content-{{ $comment->idcontent }}">{{ $comment->content->description }}</textarea>
        <input type="hidden" id="tag_id" name="tag_id" value="{{ $tag->id }}">
        <button type="button" id="editAnswerButton" onclick="editComments('{{ $comment->idcontent }}', '{{ $question->idcontent }}')">Save</button>
        <button type="button" id="editAnswerButton" onclick="cancelEditComment('{{ $comment->idcontent }}')">Cancel</button>
    </form>
@endforeach