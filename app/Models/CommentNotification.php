<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentNotification extends Model
{
    use HasFactory;

    //protected $table = 'Comment_Notification'; 


    // Relacionamento entre CommentNotification e Notification
    public function notification()
    {
        return $this->belongsTo(Notification::class, 'idnotification');
    }

    /*
    // Relacionamento entre 	CommentNotification e Comment
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'IdComment');
    }
	*/    
}
