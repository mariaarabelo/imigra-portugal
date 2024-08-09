<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //protected $table = 'Author'; 

    use HasFactory;
    
    //protected $primaryKey = ['iduser', 'idcontent'];
    protected $primaryKey = 'idcontent';
    

    public $incrementing = false;

    protected $fillable = [
        'iduser',
        'idcontent',
    ];
    
    public $timestamps = false;


    
    //Obtém o utilizador associado ao autor.
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    //Obtém o conteúdo associado ao autor.
    public function content()
    {
        return $this->belongsTo(Content::class, 'idcontent');
    }
}
