<?php


namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            "content" => $this->faker->text(40),
            "category_id" => $this->faker->numberBetween(1, 5)
        ];
    }
}
