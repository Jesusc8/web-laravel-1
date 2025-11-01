<?php

namespace App\Models;

use App\Traits\HasHeart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Italofantone\Sluggable\Sluggable;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, HasHeart, Sluggable;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function answers()
    {
        return $this->hasMany(AnswerPost::class);
    }


    protected static function booted()
    {
        static::deleting(function ($post){
            $post->hearts()->delete();

            $post->comments()->get()->each( function ($comment){
                $comment->hearts()->delete();
                
                $comment->delete();
            });

            $post->answers()->get()->each( function ($answer){
                $answer->hearts()->delete();
                
                $answer->comments()->get()->each( function ($comment){
                    $comment->hearts()->delete();

                    $comment->delete();
                });
            });
        });
    }

}
