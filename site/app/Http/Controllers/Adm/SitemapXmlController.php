<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Models\AcompanheModel;
use App\Http\Controllers\Controller;

class SitemapXmlController extends Controller
{
    public function index() {
        $posts = AcompanheModel::all();
        return response()->view('adm.index', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }

    public function updateFile(Request $request) {
        // Validate the uploaded file
        $request->validate([
            'sitemap' => 'required|file|mimes:xml|max:2048', // Adjust the validation rules as needed
        ]);

        
        // Retrieve the uploaded file instance
        $uploadedFile = $request->file('sitemap')->move(public_path('/'), 'sitemap.xml');

        // Store the uploaded file to a desired location

        return redirect()->back()->with('success', 'Sitemap uploaded successfully.');
    }
}
