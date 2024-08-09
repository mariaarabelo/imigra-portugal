<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vote;
use App\Models\UserVoteContent;
use App\Models\User;
use App\Models\Content;
use App\Models\Author;

class VoteController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'content_id' => 'required|exists:contents,id',
        ]);
    
        $idcontent = $request->content_id;
        $iduser = Auth::id();
        $hasVoted = false;

        $isAuthor = Author::where('idcontent', $idcontent)
                            ->where('iduser', $iduser)
                            ->exists();
        if ($isAuthor) {
            return response()->json(['error' => 'Authors cannot vote on their own content'], 403);
        }
    
        $existingVote = UserVoteContent::where('idcontent', $idcontent)
                                       ->where('iduser', $iduser)
                                       ->first();
    
        if ($existingVote) {
            // Remover o voto
            $vote = Vote::find($existingVote->idvote);
            UserVoteContent::where('iduser', $iduser)
                           ->where('idvote', $existingVote->idvote)
                           ->where('idcontent', $idcontent)
                           ->delete();
            $vote->delete();
            $hasVoted = false;
    
            // Decrementar pontos do autor
            $this->updateAuthorPoints($idcontent, -1);
        } else {
            // Adicionar novo voto
            $vote = Vote::create(['votedate' => now()]);
            UserVoteContent::create([
                'iduser' => $iduser,
                'idvote' => $vote->id,
                'idcontent' => $idcontent,
            ]);
            $hasVoted = true;
    
            // Incrementar pontos do autor
            $this->updateAuthorPoints($idcontent, 1);
        }
    
        return response()->json(['hasVoted' => $hasVoted]);
    }
    
    private function updateAuthorPoints($contentId, $points) {
        $author = Author::where('idcontent', $contentId)->first();
        if ($author) {
            $user = User::find($author->iduser);
            if ($user) {
                $user->increment('points', $points);
            }
        }
    }
    
    
    
}
