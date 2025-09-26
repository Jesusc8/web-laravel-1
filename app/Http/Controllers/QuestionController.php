<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

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
