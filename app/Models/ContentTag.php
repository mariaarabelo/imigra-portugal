<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentTag extends Model
{
    //protected $table = 'Content_Tags'; 
    //protected $primaryKey = ['idtag', 'idcontent'];
    protected $primaryKey = 'idcontent';

    public $timestamps = false;

    protected $fillable = [
        'idtag', 'idcontent',
    ];

    // Relação com a tabela Tag
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'idtag', 'id');
    }

    // Relação com a tabela Content
    public function content()
    {
        return $this->belongsTo(Content::class, 'idcontent', 'id');
    }
}
