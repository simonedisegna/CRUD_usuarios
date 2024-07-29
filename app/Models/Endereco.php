<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id', 'logradouro', 'numero', 'bairro', 'complemento', 'cep'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}

?>
