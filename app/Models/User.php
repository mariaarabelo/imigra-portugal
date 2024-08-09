<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    //protected $table = 'users';

    // Não adicionar timestamps de create e update no banco de dados.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'birthdate',
        'regdate',
        'points',
        'picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'Password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'datetime',
        'regdate' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->regdate = now(); // Configura a data atual para regdate
            $user->points = 0;      // Configura pontos como zero
            $user->picture = null;   // Configura picture como null
        });
    }


    // Um utilizador pode ser um administrador.
    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'iduser');
    }

    public function isAdmin()
    {
        // Verifique se há uma entrada correspondente na tabela Administrador
        return $this->administrator()->exists();
    }
    
    // Obtém todos os conteúdos associados a este utilizador através da tabela Authors.
    public function contents()
    {
        return $this->hasManyThrough(Content::class, Author::class, 'iduser', 'id', 'id', 'idcontent');
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::class, Author::class, 'iduser', 'idcontent', 'id', 'idcontent');
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Author::class, 'iduser', 'idcontent', 'id', 'idcontent');
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Author::class, 'iduser', 'idcontent', 'id', 'idcontent');
    }
    
    //Um utilizador pode enviar varios reports
    public function reports()
	{
  	  return $this->hasMany(Report::class, 'iduser');
	}
	
	 //Um utilizador pode receber varias notificacoes
    public function notifications()
	{
  	  return $this->hasMany(Notification::class, 'iduser');
	}

    // Um utilizador pode ter muitos votos em conteúdos
    public function userVoteContents()
    {
        return $this->hasMany(UserVoteContent::class, 'iduser');
    }
}

