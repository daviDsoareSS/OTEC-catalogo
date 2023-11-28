<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContatoModel extends Model
{
    use HasFactory;

    protected $table = 'contatos';

    protected $fillable = [
        'id',
        'title',
        'resume',
        'text',
        'email',
        'term',
        'telephone',
        'date',
        'time',
        'status',	
    ];

    public static function search($request) {
        $result = self::query();

        if($request->status != "0") 
            $result->where('status', '=', $request->status);
            
        if($request->search) 
            $result->where('title', 'like', '%'.$request->search.'%');
        

        if($request->order)
            return $result->orderBy('created_at', $request->order)->paginate(5);
 
        return $result->orderBy('id', 'asc')->paginate(5);
    }
}
