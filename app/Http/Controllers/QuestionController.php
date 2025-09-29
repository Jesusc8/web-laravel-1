<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

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

  public function store(Request $request)
  {

      $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
      ]);

      $question = Question::create([
        'user_id' => 20,
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
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

  public function update(Request $request, Question $question) //actualizar
  {

      $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
      ]);

      $question->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
      ]);

      return redirect()->route('questions.show', $question);
  }




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
