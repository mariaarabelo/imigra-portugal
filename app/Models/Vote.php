<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';

    public $incrementing = true; 

    // Não adicione timestamps (created_at e updated_at) no banco de dados.
    public $timestamps = false;
    
     protected $fillable = [
        'votedate',
    ];
    
    public function userVoteContents()
    {
        return $this->hasOne(UserVoteContent::class, 'idvote');
    }
}
