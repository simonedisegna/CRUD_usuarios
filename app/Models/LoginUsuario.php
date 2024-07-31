<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginUsuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'login_id',
        'usuario_id',
    ];

    protected $table = 'login_usuario';
}

?>
