<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Tag;

use App\Models\Question;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\View\View;



class MainController extends Controller
{
    public function index()
    {
        $tags = Tag::take(5)->get();
        
        $hasMoreTags = Tag::count() > 5;

        // Obtém as tags adicionais caso haja mais de 5
        $additionalTags = $hasMoreTags ? Tag::skip(5)->get() : collect();

        return view('pages.main', compact('tags', 'hasMoreTags', 'additionalTags'));
    }



    public function about()
    {
        return view('pages.about');
        
    }

    public function help()
    {
        return view('pages.help');
        
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Usando o escopo local 'search' definido no modelo Question
        $questions = Question::with(['content', 'content.contenttags'])
            ->search($query)
            ->get();

        return view('pages.search_results', compact('questions', 'query'));
    }

}
