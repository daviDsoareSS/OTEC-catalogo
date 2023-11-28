<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteModel extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'email',
        'telefone',
        'login',
        'senha',
        'id_endereco',
    ];

}
