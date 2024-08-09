<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteNotification extends Model
{
    use HasFactory;

    //protected $table = 'Vote_Notification'; 


    // Relacionamento entre VoteNotification e Notification
    public function notification()
    {
        return $this->belongsTo(Notification::class, 'idnotification');
    }

    /*
    // Relacionamento entre 	VoteNotification e Vote
    public function vote()
    {
        return $this->belongsTo(UserVoteContent::class, 'IdVote');
    }
	*/    
}
