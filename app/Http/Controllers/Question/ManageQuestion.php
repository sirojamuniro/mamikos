<?php

namespace App\Http\Controllers\Question;

use App\Models\Soal\Soal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Soal\InputQuestion;
use Str;

class ManageQuestion extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }
    public function inputQuestion(Request $request)
    {

        $question = Soal::create([
            'category' => $request->category,
            'description'=> $request->description,
            'thumbnail'=>$request->thumbnail,
            'tag'=> $request->tag,
            'price'=> $request->price
            ]);

        return $this->handleResponse(200, 'success', $question);

    }

    public function editQuestion(inputQuestion $request, $id)
    {
        $result = Soal::where('id',$id)->update([
            'category' => $request->category,
            'description'=> $request->description,
            'thumbnail'=>$request->thumbnail,
            'tag'=> $request->tag,
            'price'=> $request->price
            ]);

        return $this->handleResponse(200, 'success');
    }

    public function getQuestion()
    {
        $result = Soal::get();

        return $this->handleResponse(200, 'success', $result);
    }

    public function deleteQuestion($id)
    {
        Soal::findOrFail($id)->delete();


        return $this->handleResponse(200, 'success');
    }
}
