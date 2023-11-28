<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetatagsModel extends Model
{
    use HasFactory;

    protected $table = 'meta_tag';

    protected $fillable = [
        'id',
        'pagina',
        'descricao',
        'keywords',
    ];
}
