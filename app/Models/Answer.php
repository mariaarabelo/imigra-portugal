<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $primaryKey = 'idcontent'; 

    protected $fillable = ['idquestion', 'correct'];


    // Não adicione timestamps (created_at e updated_at) no banco de dados.
    public $timestamps = false;

	 //Obtém o conteudo associada a esta resposta.
    public function content()
    {
        return $this->belongsTo(Content::class, 'idcontent');
    }

    /**
     * Obtém a pergunta associada a esta resposta.
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 'idquestion');
    }

    /**
     * Obtém os comentários associados a esta resposta.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'idanswer', 'idcontent');
    }
}
