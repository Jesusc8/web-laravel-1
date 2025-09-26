<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'content' => 'required|string|max:1900',
        ]);

        $question->answers()->create([
            'user_id' => 20,
            'content' => $request->content,
        ]);

        return back();
    }
}
