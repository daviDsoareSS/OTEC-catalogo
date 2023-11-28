<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;

use App\Models\MetatagsModel;

use App\Http\Requests\MetatagsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
class MetatagsController extends Controller
{
    private $metatags;

    public function __construct() {
        $this->metatags = new MetatagsModel();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metatags = MetatagsModel::get();

        $routes = Route::getRoutes();
        $routeslist = [];

        foreach($routes as $value) {
            if(isset($value->action['name'])) {
                $routeslist[] = $value->uri;
            }
        }
        return view('adm.metatags.index', compact('metatags', 'routeslist'));
    }

    public function store(MetatagsRequest $request)
    {
        MetatagsModel::create([
            'pagina' => $request->pagina,
            'descricao' => $request->descricao,
            'keywords' => $request->keywords,
        ]);

        $metatags = MetatagsModel::get();

        return view('adm.metatags.pagination', compact('metatags'));
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MetatagsRequest $request, string $id)
    {
        MetatagsModel::find($request->id)->update([
            'pagina' => $request->pagina,
            'descricao' => $request->descricao,
            'keywords' => $request->keywords,
        ]);

        $metatags = MetatagsModel::get();

        return view('adm.metatags.pagination', compact('metatags'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        foreach ($request->ids as $id) {
            $metatag = MetatagsModel::find($id);

            $metatag->delete();
        }
        $metatags = MetatagsModel::get();
        return view('adm.metatags.pagination', compact('metatags'));
    }
}
