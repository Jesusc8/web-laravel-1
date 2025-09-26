<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function show(Question $question) //consulta
    {

      $question->load('answers','category', 'user'); //cargar relaciones
      return view ('questions.show', [
        'question' => $question,
      ]);
      
    }
}
