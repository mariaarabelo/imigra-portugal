<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    //protected $table = 'Notification'; 

    protected $fillable = [
        'description',
        'NotificationDate',
    ];

    // Relacionamento entre Notification e User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    // Relacionamento entre Notification e Moderator
    public function moderator()
    {
        return $this->belongsTo(Moderator::class, 'idmoderator');
    }
    
    //Cada Notificacao so pode ser de um tipo
    public function reportnotification()
    {
        return $this->hasOne(ReportNotification::class, 'idnotification');
    }
    
    public function votenotification()
    {
        return $this->hasOne(VoteNotification::class, 'idnotification');
    }
    
    public function answernotification()
    {
        return $this->hasOne(AnswerNotification::class, 'idnotification');
    }
    
    public function commentnotification()
    {
        return $this->hasOne(CommentNotification::class, 'idnotification');
    }


}
