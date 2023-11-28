<?php

namespace App\Http\Controllers\Adm;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use App\Models\AcompanheModel;
use App\Http\Requests\AcompanheRequest;
use App\Http\Controllers\Controller;
class AcompanheController extends Controller
{

    private $acompanhe;
    public function __construct() {
        $this->acompanhe = new AcompanheModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->acompanhe->checkStatusUpdate();

        $acompanhelist = $this->acompanhe->select('id', 'title', 'author', 'status')->selectRaw("DATE_FORMAT(datePost, '%d/%m/%Y %h:%i') as datePost")->orderBy('datePost', 'desc')->get();

        return view('adm.acompanhe.index', compact('acompanhelist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adm.acompanhe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcompanheRequest $request)
    {
        // Verificação caso o título de uma postagem já exista ele retorna com erro.
        $row = $this->acompanhe->where("title", "=", $request->title)->first();
        if($row) return redirect()->back()->withInput()->withErrors('O Titulo já existe.');

        $imageName = null;
        $video = null;
        /*
        Verifica se no formulário o usuário passou uma data, caso tenha passado ele salva essa data no formato d/m/Y, pois o input retorna em formato Y-m-d (ou algo assim). Caso o usuário NÃO tenha passado ele preenche com a data atual.
        */
        $date = ($request->date != null) ? date('d/m/Y', strtotime($request->date)) : date('d/m/Y');
        // Verifica se no formulário o usuário passou um horário, se sim usa o que foi passado, senão usa o horário de agora.
        $time = $request->time ?? date('H:i');
        $order = 1;
        $this->acompanhe->where('order', '>', 0)->increment('order');

        // Verificando se foi feito algum upload de imagem
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $format = $request->input('converter') ? 'webp' : $image->getClientOriginalExtension();

            $imageName = getItem('client')."-".Str::uuid().".".$format;
            $img = Image::make($image);

            $img->encode($format, 90)->save(public_path('upload/acompanhe/' . $imageName));

            // Redireciona para a página index do acompanhe com um 'success' e sua mensagem que será exibida
        }
        else if($request->video)
            $video = $request->video;

        else
            return back()->withInput()->withErrors('Adicionar uma imagem ou um link de vídeo.');

        $datePost = Carbon::createFromFormat('d/m/Y H:i', $date . ' ' . $time)->setTimezone('America/Sao_Paulo');
        // Cria um novo acompanhe com as informações

        $acompanhe = $this->acompanhe->create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'text' => $request->text,
            'author' => $request->author,
            'type' => $request->type,
            'url' => cleanUrl($request->title),
            'image' => $imageName,
            'video' => $video,
            'status' => ($datePost > Carbon::now('America/Sao_Paulo')) ? "Pendente" : "Publicado",
            'date' => $date,
            'time' => $time,
            'datePost' => $datePost,
            'order' => $order,
        ]);

        if($acompanhe)
            return redirect()->route('acompanhe.index')->with('success', 'Seus dados foram cadastrados com sucesso');


        return redirect()->route('acompanhe.index')->withErrors('Algo ocorreu errado!!');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $acompanhe = $this->acompanhe->find($id);
        $data = date('Y-m-d', strtotime(str_replace('/', '-', $acompanhe->date)));

        return view('adm.acompanhe.edit', compact('acompanhe', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcompanheRequest $request, string $id)
    {

        $row = $this->acompanhe->where('title', '=', $request->title)->where('id', '<>', $id)->first();
        if($row)
            return redirect()->back()->withErrors('O Titulo já existe.');


        $acompanhe = $this->acompanhe->find($id);
        $imageName = $acompanhe->image;
        $video = $acompanhe->video;

        $date = ($request->date != null) ? date('d/m/Y', strtotime($request->date)) : $acompanhe->date;

        $time = $request->time ?? date('H:i');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $format = $request->input('converter') ? 'webp' : $image->getClientOriginalExtension();
            $imageName = getItem('client') . "-" . Str::uuid() . "." . $format;
            $img = Image::make($image);

            if(File::exists('upload/acompanhe/'.$acompanhe->image))
                File::delete('upload/acompanhe/'.$acompanhe->image);

            $img->encode($format, 90)->save(public_path('upload/acompanhe/' . $imageName));

        } else if ($request->video) {
            $video = $request->video;
            $imageName = "";
            if (File::exists('upload/acompanhe/' . $acompanhe->image))
                File::delete('upload/acompanhe/' . $acompanhe->image);
        }


        $datePost = Carbon::createFromFormat('d/m/Y H:i', $date . ' ' . $time);

        $acompanhe = $acompanhe->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'text' => $request->text,
            'author' => $request->author,
            'type' => $request->type,
            'image' => $imageName,
            'video' => $video,
            'status' => ($datePost > Carbon::now()) ? "Pendente" : "Publicado",
            'date' => $date,
            'time' => $time,
            'datePost' => $datePost,
        ]);

        if($acompanhe)
            return redirect()->route('acompanhe.index')->with('success', 'Seus dados foram editados com sucesso');


        return redirect()->route('acompanhe.index')->withErrors('Algo ocorreu errado!!');
    }

    public function selected(Request $request) {
        $acompanhelist = $this->acompanhe->whereIn('id', $request->selectedIds)->get('title');

        return response()->json($acompanhelist, 200);
    }

    public function orderIndex() {
        $this->acompanhe->checkStatusUpdate();
        $acompanhelist = $this->acompanhe->orderBy('order', 'asc')->get();
        return view("adm.acompanhe.order", compact('acompanhelist'));
    }

    public function orderUpdate(Request $request) {
        $orderData = $request->input('order');

        foreach ($orderData as $index => $itemId) {
            $acompanhe = $this->acompanhe->findOrFail($itemId);
            $acompanhe->order = $index + 1;
            $acompanhe->save();
        }

        $acompanhelist = $this->acompanhe->orderBy('order', 'asc')->get();
        return view('adm.acompanhe.order-table', compact('acompanhelist'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        foreach ($request->ids as $id) {
            $acompanhe = $this->acompanhe->find($id);

            $this->acompanhe->where('order', '>', $acompanhe->order)->decrement('order');

            preg_match_all('/<img[^>]+src="([^">]+)"/i', $acompanhe->text, $matches);
            $imageUrls = $matches[1];

            // Delete the corresponding image files from storage
            foreach ($imageUrls as $imageUrl) {
                $imageName = basename($imageUrl);
                File::delete('upload/acompanhe/ckeditor/' . $imageName);
            }

            if(File::exists('upload/acompanhe/'.$acompanhe->image))
                File::delete('upload/acompanhe/'.$acompanhe->image);


            $acompanhe->delete();
        }

        $acompanhelist = $this->acompanhe->orderBy('order', 'asc')->get();

        return view('adm.acompanhe.pagination-ajax', compact('acompanhelist'));
    }


    public function ckeditorUpload(Request $request) {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('upload/acompanhe/ckeditor/'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('upload/acompanhe/ckeditor/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}

