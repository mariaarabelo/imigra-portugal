<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    // protected $table = 'contents'; 
    protected $primaryKey = 'id';

    public $incrementing = true; 
    public $timestamps = false;

    protected $fillable = [
        'description', 'contentdate',
    ];

    // Relação com a tabela ContentTag
    public function contentTags()
    {
        return $this->hasOne(ContentTag::class, 'idcontent');
    }
    
     // Cada content tem um autor.
    public function author()
    {
        return $this->hasOne(Author::class, 'idcontent');
    }
    
    public function question()
    {
        return $this->hasOne(Question::class, 'idcontent');
    }
    
    public function answer()
    {
        return $this->hasOne(Answer::class, 'idcontent');
    }
    
    public function comment()
    {
        return $this->hasOne(Comment::class, 'idcontent');
    }
    
    //Um conteudo pode ter varias alteracoes
    public function changes()
    {
        return $this->hasMany(Change::class, 'idcontent');
    }
    
    //Um conteudo pode receber varios reports
    public function reports()
    {
        return $this->hasMany(Report::class, 'idcontent');
    }

    // Um conteúdo pode ter muitos votos de utilizadores
    public function userVoteContents()
    {
        return $this->hasMany(UserVoteContent::class, 'idcontent');
    }

    public function userHasVoted()
    {
        return $this->hasOne(UserVoteContent::class, 'idcontent', 'id')
                    ->where('iduser', auth()->id());
    }

}
