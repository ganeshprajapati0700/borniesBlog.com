<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(fake()->numberBetween(4, 9));
        $title = rtrim($title, '.');

        $categoryId = Category::inRandomOrder()->value('id');
        $subCategoryId = SubCategory::where('category_id', $categoryId)->inRandomOrder()->value('id')
            ?? SubCategory::inRandomOrder()->value('id');

        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'category_id' => $categoryId,
            'sub_category_id' => $subCategoryId,
            'type' => fake()->randomElement(['news', 'article', 'interview']),
            'title' => $title,
            'slug' => Str::slug($title),
            'views' => fake()->numberBetween(0, 5000),
            'shortDesc' => fake()->sentence(fake()->numberBetween(10, 25)),
            'description' => '<p>'.implode('</p><p>', fake()->paragraphs(fake()->numberBetween(3, 7))).'</p>',
            'image_path' => null,
            'status' => fake()->randomElement([0, 1, 1]),
            'published_at' => fake()->optional(0.8)->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /** Post is published. */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 1,
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    /** Post is a draft. */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 0,
            'published_at' => null,
        ]);
    }
}
