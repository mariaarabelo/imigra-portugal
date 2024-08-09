<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerNotification extends Model
{
    use HasFactory;

    //protected $table = 'Answer_Notification'; 


    // Relacionamento entre ReportNotification e Notification
    public function notification()
    {
        return $this->belongsTo(Notification::class, 'idnotification');
    }

    /*
    // Relacionamento entre 	AnswerNotification e Answer
    public function answer()
    {
        return $this->belongsTo(Answer::class, 'IdAnswer');
    }
	*/    
}
