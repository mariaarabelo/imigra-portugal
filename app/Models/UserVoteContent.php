<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserVoteContent extends Model
{
    public $incrementing = false;
    protected $primaryKey = null;
    
    // Não adicione timestamps (created_at e updated_at) no banco de dados.
    public $timestamps = false;

    protected $fillable = [
        'iduser', 'idvote', 'idcontent',
    ];
  
     //Obtém o usuário associado a este voto em conteúdo.
    public function users()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    //Obtém o voto associado a este voto em conteúdo.
    public function votes()
    {
        return $this->belongsTo(Vote::class, 'idvote');
    }

    //Obtém o conteúdo associado a este voto em conteúdo.
    public function contents()
    {
        return $this->belongsTo(Content::class, 'idcontent');
    }
}
