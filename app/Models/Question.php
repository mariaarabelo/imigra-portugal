<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    // protected $table = 'Questions'; 
    protected $primaryKey = 'idcontent';

    // Não adicione timestamps (created_at e updated_at) no banco de dados.
    public $timestamps = false;
    
    protected $fillable = [
        'title',
    ];

	//Obtém o conteudo associada a esta pergunta.
    public function content()
    {
        return $this->belongsTo(Content::class, 'idcontent');
    }

     //Obtém a resposta associada a esta pergunta.
    public function answers()
    {
        return $this->hasMany(Answer::class, 'idquestion', 'idcontent');
    }
    
    //Obtém o comentario associada a esta pergunta.
    public function comments()
    {
        return $this->hasMany(Comment::class, 'idquestion', 'idcontent');
    }

    public function scopeSearch(Builder $query, $searchTerm){
        return $query->where('title', 'like', '%'. $searchTerm . '%')
            ->orWhereHas('content', function ($q) use ($searchTerm){
                $q->where('description', 'like', '%' . $searchTerm . '%');
            });
    }
}
