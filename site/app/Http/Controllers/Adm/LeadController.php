<?php

namespace App\Http\Controllers\Adm;

use App\Mail\LeadMail;
use Illuminate\Http\Request;
use App\Models\LeadModel;
use App\Http\Requests\LeadRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
class LeadController extends Controller
{
    private $leads;

    public function __construct() {
        $this->leads = new LeadModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $leads = $this->leads->orderBy('created_at', 'desc')->get();
        return view('adm.leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adm.leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeadRequest $request)
    {
        $leads = $this->leads->create([
            'title' => $request->title,
            'telephone' => $request->telephone,
            'date' => date('d/m/Y'),
            'time' => date('H:i'),
            'status' => 'Não lido',
        ]);

        if($leads) {
            $data = [
                'url' => '',
                'nome' => $request->title,
                'telefone' => $request->telephone,
            ];
            Mail::to('web@engenhodeimagens.com.br')->send(new LeadMail($data));

            return redirect()->route('leads.index')->with('success', 'Dados cadastrado com sucesso');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leads = $this->leads->find($id);
        $leads->status = "lido";
        $leads->save();


        return view('adm.leads.edit', compact('leads'));
    }

    public function selected(Request $request) {
        $leads = $this->leads->whereIn('id', $request->selectedIds)->get('title');

        return response()->json($leads, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeadRequest $request, string $id)
    {
        $this->leads->find($id)->update($request->all());

        return redirect()->route('leads.index')->with('success', 'Seus dados foram editados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        foreach ($request->ids as $id) {
            $leads = $this->leads->find($id);
            $leads->delete();
        }

        $leads = $this->leads->orderBy('created_at', 'asc')->get();
        return view('adm.leads.pagination', compact('leads'));
    }
}
