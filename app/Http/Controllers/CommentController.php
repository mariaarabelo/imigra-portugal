<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Content;
use App\Models\Question;
use App\Models\Answer;

class CommentController extends Controller
{
    public function update(Request $request, $id)
    {
        $content = Content::find($id);
        $this->authorize('update', $content);

        $comment = Comment::findOrFail($id);
        $comment->content->description = $request->input('edited_content');
        $comment->content->save();

        return response()->json([
            'message' => 'Comment updated successfully!',
        ]);
    }

    public function destroy($id, $idTag)
    {
        $content = Content::find($id);
        $this->authorize('delete', $content);
    
        // Encontrar o comentário e os votos associados
        $comment = Comment::findOrFail($id);
    
        // Excluir os votos associados ao conteúdo do comentário
        foreach ($comment->content->userVoteContents as $vote) {
            $vote->delete();
        }
    
        // Excluir o comentário
        $comment->delete();
    
        return redirect()->route('questions.byTag', ['idTag' => $idTag])->with('success', 'Comment deleted successfully');
    }    

    public function storeQ(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,idcontent',
            'description' => 'required|string',
        ]);

        $content = new Content();
        $content->description = $request->description;
        $content->contentdate = now();
        $content->save();

        $question = Question::find($request->question_id);

        // Associar o comentário à pergunta
        $comment = $content->comment()->create([
            'idquestion' => $question->idcontent,
            'idanswer' => null,
        ]);

        $question->comments()->save($comment);

        $userId = Auth::id();

        $content->author()->create([
           'iduser' => $userId,
           'idcontent' => $content->id,
        ]);

        return response()->json([
            'message' => 'Comment created successfully!',
       ]);
    }

    public function storeA(Request $request)
    {
        $request->validate([
            'answer_id' => 'required|exists:answers,idcontent',
            'description' => 'required|string',
        ]);

        $content = new Content();
        $content->description = $request->description;
        $content->contentdate = now();
        $content->save();

        $answer = Answer::find($request->answer_id);

        // Associar o comentário à resposta
        $comment = $content->comment()->create([
            'idquestion' => null,
            'idanswer' => $answer->idcontent,
        ]);

        $answer->comments()->save($comment);

        $userId = Auth::id();

        $content->author()->create([
           'iduser' => $userId,
           'idcontent' => $content->id,
        ]);

        return response()->json([
            'message' => 'Comment created successfully!',
       ]);
    }
}
