<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'celular',
        'cpf',
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function login()
    {
        return $this->hasOneThrough(Login::class, LoginUsuario::class, 'usuario_id', 'id', 'id', 'login_id');
    }
}

?>
