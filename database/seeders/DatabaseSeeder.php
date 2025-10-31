<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\AnswerPost;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Question;
use App\Models\User;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(19)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'j@test.com',
        ]);


        $categories = Category::factory(4)->create();

        $questions = Question::factory(30)->create([
            'user_id'     => fn() => User::inRandomOrder()->first()->id,
            'category_id' => fn() => $categories->random()->id, //consulta diferida
        ]);
        
        $posts = Post::factory(20)->create([
            'user_id'     => fn() => User::inRandomOrder()->first()->id,
            'category_id' => fn() => $categories->random()->id, //consulta diferida
        ]);

        $answers = Answer::factory(30)->create([
            'user_id'     => fn() => User::inRandomOrder()->first()->id,
            'question_id' => fn() => $questions->random()->id, //consulta diferida

        ]);

        $post_answers = AnswerPost::factory(30)->create([
            'user_id'     => fn() => User::inRandomOrder()->first()->id,
            'post_id'     => fn() => $posts->random()->id, //consulta diferida

        ]);

        //relacion polimorfica

        Comment::factory(100)->create([
            'user_id'        => fn() => User::inRandomOrder()->first()->id,
            'commentable_id' => fn() => $answers->random()->id, //consulta diferida
            'commentable_type' => Answer::class,

        ]);

        Comment::factory(100)->create([
            'user_id'          =>fn() => User::inRandomOrder()->first()->id,
            'commentable_id'   => fn() => $questions->random()->id, //consulta diferida
            'commentable_type' => Question::class,

        ]);

        Comment::factory(50)->create([
                'user_id'         => fn() => User::inRandomOrder()->first()->id,
                'commentable_id'   => fn()=> $post_answers->random()->id,
                'commentable_type' => Post::class,
        ]);


    }
    
}
