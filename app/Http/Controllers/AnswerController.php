<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\Content;
use App\Models\Author;
use App\Models\UserVoteContent;


class AnswerController extends Controller
{

    public function getAnswers($questionId)
    {
        $answers = Answer::with(['content', 'content.author.user', 'comments', 'comments.content.author.user'])
            ->where('idquestion', $questionId)
            ->get();

        return response()->json(['answers' => $answers]);
    }


    public function destroy($id, $idTag)
    {
        $content = Content::find($id);
        $this->authorize('delete', $content);
    
        $answer = Answer::findOrFail($id);
    
        foreach ($answer->comments as $comment) {
            UserVoteContent::where('idcontent', $comment->idcontent)->delete();
            $comment->delete();
        }
    
        UserVoteContent::where('idcontent', $answer->idcontent)->delete();
    
        $answer->delete();
    
        return redirect()->route('questions.byTag', ['idTag' => $idTag])->with('success', 'Answer deleted successfully');
    }
    
    public function update(Request $request, $id)
    {
        $content = Content::find($id);
        $this->authorize('update', $content);

        $answer = Answer::findOrFail($id);
        $answer->content->description = $request->input('edited_content');
        $answer->content->save();

        return response()->json([
            'message' => 'Answer updated successfully!',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,idcontent',
            'description' => 'required|string',
        ]);

        $content = new Content();
        $content->description = $request->description;
        $content->contentdate = now();
        $content->save();

        $content->answer()->create([
            'idquestion' => $request->question_id,
            'correct' => 0, 
        ]);

        $userId = Auth::id();
        $content->author()->create([
            'iduser' => $userId,
        ]);

        return response()->json([
            'message' => 'Answer created successfully!',
        ]);
    }
}
