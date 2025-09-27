<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(Question $question) //consulta
    {

      $userId = 20;

      $question ->load([
        'user',
        'category',

        'answers' => fn($query) => $query->with ([
            'user',
            'hearts' => fn($query) => $query->where('user_id', $userId),
            'comments' =>fn($query) => $query->with([
                'user',
                'hearts' => fn($query) => $query->where('user_id', $userId)
            ]),
          ]),

          'comments' => fn ($query) =>$query->with([
            'user',
            'hearts' => fn($query) => $query->where('user_id', $userId) 

          ]),

        'hearts' => fn($query) => $query->where('user_id', $userId),

      ]);


      return view('questions.show', compact('question'));
      
    }

    public function destroy(Question $question) //eliminar
    {

      $question->delete(); //eliminar la pregunta

      return redirect()->route('home'); //redireccionar con mensaje de éxito


    }

}
