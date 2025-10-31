<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'content' => 'required|string|max:1900',
        ]);

        if (isset($question)){

            $question->answers()->create([
                'user_id' => auth()->id(),
                'content' => $request->content,
            ]);

        }


        return back();
    }

    
}
