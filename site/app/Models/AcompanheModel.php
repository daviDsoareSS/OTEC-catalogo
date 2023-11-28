<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AcompanheModel extends Model
{
    use HasFactory;

    protected $table = "acompanhes";

    protected $fillable = [
        'id',
        'title',
        'subtitle',
        'text',
        'author',
        'type',
        'url',
        'image',
        'video',
        'status',
        'date',
        'time',
        'datePost',
        'order',
    ];

    public static function search($request)
    {
        $result = self::query();

        if ($request->status != "0")
            $result->where('status', '=', $request->status);

        if ($request->search)
            $result->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('date', 'like', '%' . $request->search . '%');

        switch ($request->order) {
            case 'ordem':
                return $result->orderBy('order', 'asc')->paginate(5);

            case 'asc':
                return $result->orderBy('datePost', $request->order)->paginate(5);

            case 'desc':
                return $result->orderBy('datePost', $request->order)->paginate(5);
        }
        return $result->orderBy('id', 'asc')->paginate(5);
    }

    public static function checkStatusUpdate()
    {
        $currentDateTime = Carbon::now('America/Sao_Paulo');

        $acompanhelist = AcompanheModel::where('status', 'Pendente')->select('datePost', 'status')->get();

        foreach ($acompanhelist as $acompanhe) {
            if ($currentDateTime->isAfter($acompanhe->datePost)) {
                $acompanhe->update([
                    'status' => 'Publicado',
                ]);
            }
        }
    }
}
