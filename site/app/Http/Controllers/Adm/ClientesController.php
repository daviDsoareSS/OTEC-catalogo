<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Models\ClienteModel;
use App\Http\Requests\ContatoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clientes = ClienteModel::orderBy('created_at', 'desc')->get();

        return view('adm.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adm.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContatoRequest $request)
    {
        $contato = ContatoModel::create([
            'title' => $request->title,
            'text' => $request->text,
            'email' => $request->email,
            'term' => 'off',
            'telephone' => $request->telephone,
            'time' => date('H:i'),
            'date' => date('d/m/Y'),
            'status' => 'Não lido'
        ]);

        if ($contato)
            $data = [
                'url' => '',
                'nome' => $request->title,
                'telefone' => $request->telephone,
            ];
        Mail::to('web@engenhodeimagens.com.br')->send(new ContatoMail($data));
        return redirect()->route('contato.index')->with('success', 'Dados cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contato = ContatoModel::find($id);
        $contato->status = 'lido';
        $contato->save();

        return view('adm.contato.edit', compact('contato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContatoRequest $request, string $id)
    {
        $contato = ContatoModel::find($id)->update($request->all());

        if ($contato)
            return redirect()->route('contato.index')->with('success', 'Dados cadastrado com sucesso');

        return redirect()->back()->withErrors('Algo de errado ocorreu na tentativa de editar um contato');
    }

    public function selected(Request $request)
    {
        $contatos = ContatoModel::whereIn('id', $request->selectedIds)->get('title');

        return response()->json($contatos, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        foreach ($request->ids as $id) {
            $contato = ContatoModel::find($id);
            $contato->delete();
        }

        $contatos = ContatoModel::orderBy('created_at', 'asc')->paginate(5);
        return view('adm.contato.pagination', compact('contatos'));
    }
}
