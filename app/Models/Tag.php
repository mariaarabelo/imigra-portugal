<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //protected $table = 'tags'; 
    //protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = [
        'description',
    ];

    // Relação com a tabela ContentTag
    public function contentTags()
    {
        return $this->hasMany(ContentTag::class, 'IdTag', 'Id');
    }
}
