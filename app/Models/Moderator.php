<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Moderator extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    //protected $table = 'Moderator'; 

    // Não adicione timestamps (created_at e updated_at) no banco de dados.
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthdate',
        'regdate',
        'picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthdate' => 'date',
        'regdate' => 'date',
        'password' => 'hashed',
    ];
    
    //Um moderator pode receber varios reports
    public function reports()
	{
  	  return $this->hasMany(Report::class, 'IdModerator');
	}
	
	 //Um moderador pode receber varias notificacoes
    public function notification()
	{
  	  return $this->hasMany(Notification::class, 'IdModerator');
	}
}
