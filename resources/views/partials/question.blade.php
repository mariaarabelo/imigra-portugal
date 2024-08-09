<div class="question_id">
    @if($question->content->author)
        <div id = "author-info">
            <span id="picture" title="User Picture"> <i class="fa fa-user-circle" aria-hidden="true"></i> </span>
            <a id = "author" href="{{ route('profile.show', $question->content->author->user->id) }}">{{ $question->content->author->user->name }}</a>
            <div class="options-container">
                <button class="options-button" onclick="toggleQuestionOptions({{ $question->idcontent }})"> 
                    <span id="picture" title="Options"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </span>
                </button>
                <div class="options-list" id="optionsList-{{ $question->idcontent }}">
                   <a href="#"> <i class="fa fa-info-circle" aria-hidden="true"></i> View Info</a>
                   <a href="{{ route('questions.edit', ['id' => $question->idcontent, 'idTag' => $tag->id]) }}"> <i class="fa fa-magic" aria-hidden="true"></i> Edit Question</a>
                   <a href="#" onclick="confirmDeleteQuestion({{ $question->idcontent }})"> <i class="fa fa-trash" aria-hidden="true"></i> Delete Question</a>
                   <a href="#"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Report Question</a>
                </div>

                {{-- Formulário oculto para a exclusão --}}
                <form id="delete-question-form-{{ $question->idcontent }}" action="{{ route('questions.destroy', ['id' => $question->idcontent, 'idTag' => $tag->id]) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    @endif

    <a href="#" class="button callAnswers" data-questionid="{{ $question->idcontent }}" >{{ $question->title }}</a>
    <p>{{ $question->content->description }}</p>

    <div id="question-plus">
        <button class="vote-button" onclick="voteContent({{ $question->idcontent }}, {{ Auth::user() ? Auth::user()->id : 'null' }})">
            <span id="vote-icon-{{ $question->idcontent }}" title="Vote" class="{{ $question->content->userHasVoted ? 'voted' : 'not-voted' }}"> <i class="fa fa-thumbs-up" aria-hidden="true"></i>  </span>
        </button>

        <button class="comments-button" onclick="toggleComments({{ $question->idcontent }})"> 
            <span id="picture" title="View Comments"> <i class="fa fa-comments" aria-hidden="true"></i>  </span>
        </button>
        <span id="date">{{ $question->content->contentdate }}</span>
    </div>

    {{-- Área para exibir comentários --}}
    <div class="comments-container" id="commentsContainer-{{ $question->idcontent }}">
        @forelse ($question->comments as $comment)
            <div class="comment">
               <div id = "author-info">
                   <span class="author-name">{{ $comment->content->author->user->name }}</span>
                   <div class="options-container">
                        <button class="options-button" onclick="toggleCommentOptions(this)"> 
                            <span id="picture" title="Options"> <i class="fa fa-ellipsis-v" aria-hidden="true"></i> </span>
                        </button>
                        <div class="options-list" id="optionsList-{{ $comment->idcontent }}">
                            <a href="#"> <i class="fa fa-info-circle" aria-hidden="true"></i> View Info</a>
                            <a href="#" onclick="openEditCommentForm({{ $comment->idcontent }})"> <i class="fa fa-magic" aria-hidden="true"></i> Edit Comment</a>
                            <a href="#" onclick="confirmDeleteComment({{ $comment->idcontent }})"> <i class="fa fa-trash" aria-hidden="true"></i> Delete Comment</a>
                            <a href="#"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Report Comment </a>
                        </div>

                        {{-- Delete Comment form (initially hidden) --}}
                        <form id="delete-comment-form-{{ $comment->idcontent }}" action="{{ route('comments.destroy', ['id' => $comment->idcontent, 'idTag' => $tag->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>

                <p class="comment-content">{{ $comment->content->description }}</p>

                <div id="comment-plus">
                    <button class="vote-button" onclick="voteContent({{ $comment->idcontent }}, {{ Auth::user() ? Auth::user()->id : 'null' }})">
                        <span id="vote-icon-{{ $comment->idcontent }}" title="Vote" class="{{ $comment->content->userHasVoted ? 'voted' : 'not-voted' }}"> <i class="fa fa-thumbs-up" aria-hidden="true"></i>  </span>
                    </button>

                    <span id="date">{{ $question->content->contentdate }}</span>
                </div>

                {{-- Edit Comment form (initially hidden) --}}
                <form id="edit-comment-form-{{ $comment->idcontent }}" class="edit-comment-form" style="display: none;" method="post">
                    @csrf
                    @method('PUT')
                   <textarea name="edited_content" id="edited-content-{{ $comment->idcontent }}">{{ $comment->content->description }}</textarea>
                   <input type="hidden" id="tag_id" name="tag_id" value="{{ $tag->id }}">
                   <button type="button" id="editAnswerButton" onclick="editComments('{{ $comment->idcontent }}', '{{ $question->idcontent }}')">Save</button>
                   <button type="button" id="editAnswerButton" onclick="cancelEditComment('{{ $comment->idcontent }}')">Cancel</button>
                </form>
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse

        @if (Auth::check())
            <div class="typeComment">
                <form id="sendComment">
                    @csrf
                    <input type="hidden" id="tag_id" name="tag_id" value="{{ $tag->id }}">
                    <input type="text" id="comment-question-description-{{ $question->idcontent }}" name="description" placeholder="Write your comment...">
                    <button type="submit" id="sendCommentButton" onclick="sendQuestionComment({{ $question->idcontent }})">
                        <span id="picture" title="Send Comment"> <i class="fa fa-paper-plane" aria-hidden="true"></i> </span>
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>