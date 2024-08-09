<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Content;
use App\Models\ContentTag;
use App\Models\Tag;
use App\Models\Author;
use App\Models\UserVoteContent;

class QuestionController extends Controller
{
    public function show($id)
    {
        $question = Question::findOrFail($id);

        return view('questions.show', compact('question'));
    }
    
    public function showByTag($idTag)
    {
        $tag = Tag::where('id', $idTag)->first();

        $questions = Question::with(['content', 'answers', 'content.author.user', 'answers.comments'])->join('content_tags', 'questions.idcontent', '=', 'content_tags.idcontent')
        ->where('content_tags.idtag', '=', $idTag)
        ->get();

        return view('pages.question', compact('questions', 'tag'));
    }
    
    public function create($idTag)
    {
        $selectedTag = Tag::findOrFail($idTag);
        $tags = Tag::all();

        return view('pages.createquestion', compact('tags', 'selectedTag'));
    }

    public function destroy($id, $idTag)
    {
        $content = Content::find($id);
        $this->authorize('delete', $content);
    
        $question = Question::findOrFail($id);
    
        foreach ($question->answers as $answer) {
            foreach ($answer->comments as $comment) {
                UserVoteContent::where('idcontent', $comment->idcontent)->delete();
                $comment->delete();
            }
    
            UserVoteContent::where('idcontent', $answer->idcontent)->delete();
            $answer->delete();
        }

        foreach($question->comments as $comment) {
            UserVoteContent::where('idcontent', $comment->idcontent)->delete();
            $comment->delete();
        }
    
        UserVoteContent::where('idcontent', $question->idcontent)->delete();

        $question->delete();
    
        return redirect()->route('questions.byTag', ['idTag' => $idTag])->with('success', 'Question deleted successfully');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tag' => 'required|exists:tags,id',
        ]);

        $content = new Content();
        $content->description = $request->content;
        $content->contentdate = now();
        $content->save(); 

        $content->question()->create([
            'title' => $request->title,
        ]);

        $content->contenttags()->create([
            'idtag' => $request->tag,
        ]);

        $userId = Auth::id();
        $content->author()->create([
            'iduser' => $userId,
        ]);

        return redirect()->route('questions.byTag', ['idTag' => $request->tag]);
    }

    public function edit($id, $idTag)
    {
        $content = Content::find($id);
        $this->authorize('update', $content);
        

        $question = Question::find($id);
        $selectedTag = Tag::findOrFail($idTag);
        $tags = Tag::all(); 

        return view('pages.editquestion', compact('question', 'tags', 'selectedTag'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'tag' => 'required|exists:tags,id',
        ]);

        $question = Question::findOrFail($id);
        $question->title = $request->title;
        $question->content->description = $request->content;
        $question->content->contenttags->idtag = $request->tag;
        $question->content->save();
        $question->save();

        return redirect()->route('questions.byTag', ['idTag' => $request->tag])
                ->with('success', 'Question updated successfully!');

    }
}
