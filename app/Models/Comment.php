<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    // protected $table = 'Comments'; 
    protected $primaryKey = 'idcontent';
    protected $fillable = ['idquestion', 'idanswer'];

    // Não adicione timestamps (created_at e updated_at) no banco de dados.
    public $timestamps = false;


	 //Obtém o conteudo associada a este comentário.
    public function content()
    {
        return $this->belongsTo(Content::class, 'idcontent');
    }


     //Obtém a resposta associada a este comentário.
    public function answer()
    {
        return $this->belongsTo(Answer::class, 'idanswer', 'idcontent');
    }

     //Obtém a pergunta associada a este comentário.
    public function question()
    {
        return $this->belongsTo(Question::class, 'idquestion', 'idcontent');
    }
}
