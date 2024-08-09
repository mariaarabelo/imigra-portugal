<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionNotification extends Model
{
    use HasFactory;

    //protected $table = 'Question_Notification'; 


    // Relacionamento entre QuestionNotification e Notification
    public function notification()
    {
        return $this->belongsTo(Notification::class, 'idnotification');
    }

    /*
    // Relacionamento entre QuestionNotification e Question
    public function question()
    {
        return $this->belongsTo(Question::class, 'IdQuestion');
    }
	*/    
}
