<?php

namespace App\Models;

use Iluminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    //protected $table = 'Report'; 

    // Não adicione timestamps (created_at e updated_at) no banco de dados.
    public $timestamps = false;

    protected $fillable = [
        'iduser',
        'idcontent',
        'idmoderator',
        'description',
        'reportdate',
        'status',
    ];

    // Relacionamento entre Report e Moderator
    public function moderator()
    {
        return $this->belongsTo(Moderator::class, 'idmoderator');
    }
    
    // Relacionamento entre Report e User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
    
    // Relacionamento entre Report e Content
    public function content()
    {
        return $this->belongsTo(Content::class, 'idcontent');
    }
}
