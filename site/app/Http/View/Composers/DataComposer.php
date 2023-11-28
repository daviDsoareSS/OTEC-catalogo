<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\ContatoModel;
use App\Models\LeadModel;
use App\Models\User;
use Illuminate\Support\Facades\Cache; // Import the Cache facade

class DataComposer
{
    public function compose(View $view)
    {

        $userCacheKey = 'user';

        $notificacaoContatos = ContatoModel::select('id', 'title', 'telephone')
                ->where('status', '=', 'Não lido')
                ->orderBy('created_at', 'desc')
                ->get()
                ->all();

        $notificacaoLeads = LeadModel::select('id', 'title', 'telephone')
                ->where('status', '=', 'Não lido')
                ->orderBy('created_at', 'desc')
                ->get()
                ->all();

        $user = Cache::remember($userCacheKey, $minutes = 60, function () {
            return User::select('name', 'image')->first();
        });

        $view->with([
            'notificacaoContatos' => $notificacaoContatos,
            'notificacaoLeads' => $notificacaoLeads,
            'user' => $user,
        ]);
    }
}
