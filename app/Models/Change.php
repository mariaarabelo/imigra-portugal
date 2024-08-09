<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    use HasFactory;
    
    //protected $table = 'Change'; 

    // Não adicione timestamps (created_at e updated_at) no banco de dados.
    public $timestamps = false;
    
    protected $fillable = [
        'description', 'ChangeDate',
    ];
    
    //Obtém o conteúdo associado a esta mudança.
    public function content()
    {
        return $this->belongsTo(Content::class, 'IdContent');
    }
}
