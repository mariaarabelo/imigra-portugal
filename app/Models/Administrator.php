<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    // Defina o nome da tabela associada ao modelo
    //protected $table = 'Administrator';

    // Não adicione timestamps (created_at, updated_at) à tabela
    public $timestamps = false;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'IdUser',
    ];

    /**
     * Obtém o usuário associado ao administrador.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'IdUser');
    }
}
