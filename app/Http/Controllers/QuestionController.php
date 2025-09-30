<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Category;
use App\Models\Question;
use App\Support\QuestionShowLoader;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
  public function index() 

  {
      $questions = Question::with([

        'user',
        'category'

      ])
      ->latest()
      ->paginate(24);

        return view ('questions.index', [
          'questions' => $questions
        ]);
  }

  public function create() //mostrar el diseno del formulario
  {

      $categories = Category::all();
      return view('questions.create', [
        'categories' => $categories
      ]);
  }

  public function store(StoreQuestionRequest $request)
  {

      $question = Question::create([
        'user_id' => Auth::id(),
        ...$request->validated(),
      ]);

      return redirect()->route('questions.show', $question);
  }


  public function edit(Question $question) //Muestra el formulario
  {

      $categories = Category::all();

      return view('questions.edit', [
        'question' => $question,
        'categories' => $categories
      ]);
  }

  public function update(UpdateQuestionRequest $request, Question $question) //actualizar
  {

      $question->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
      ]);

      return redirect()->route('questions.show', $question);
  }




  public function show(Question $question, QuestionShowLoader $loader) //consulta
  {

      $loader->load($question);


      return view('questions.show', compact('question'));
      
  }

    public function destroy(Question $question) //eliminar
    {

      $question->delete(); //eliminar la pregunta

      return redirect()->route('home'); //redireccionar con mensaje de éxito


    }

}
