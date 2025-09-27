<?php

namespace App\Models;

use App\Traits\HasHeart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /** @use HasFactory<\Database\Factories\AnswerFactory> */
    use HasFactory, HasHeart;


    protected $fillable = [
        'user_id',
        'content', 
    ];
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
