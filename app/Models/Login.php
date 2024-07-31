<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable
{
    use Notifiable;

    protected $table = 'logins';

    protected $fillable = [
        'nome', 'email', 'senha', 'nivel',
    ];

    protected $hidden = [
        'senha', 'remember_token',
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'login_usuario');
    }

    protected $casts = [
        'email_verificado_em' => 'datetime',
    ];

    // Informar ao Laravel qual campo deve ser usado como senha
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
?>
