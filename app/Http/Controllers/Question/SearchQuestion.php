<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal\Soal;

class SearchQuestion extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }
    public function searchQuestion(Request $request)
    {

        $search = $request->input('search');

        $question = Soal::where('category','LIKE','%'.$search.'%')
                        ->orWhere('description','LIKE','%'.$search.'%')
                        ->orWhere('thumbnail','LIKE','%'.$search.'%')
                        ->orWhere('tag','LIKE','%'.$search.'%')
                        ->orWhere('price','LIKE','%'.$search.'%')
                        ->get();

        return $this->handleResponse(200, 'success', $question);

    }

    public function searchQuestionByCategory(Request $request)
    {

        $search = $request->input('search_category');

        $question = Soal::where('category','LIKE','%'.$search.'%')
                        ->get();

        return $this->handleResponse(200, 'success', $question);

    }
}
