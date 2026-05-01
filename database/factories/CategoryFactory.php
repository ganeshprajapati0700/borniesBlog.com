<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Technology', 'Travel', 'Health & Wellness', 'Food & Recipes',
            'Business', 'Lifestyle', 'Finance', 'Education', 'Entertainment',
            'Sports', 'Science', 'Politics', 'Culture', 'Environment', 'Fashion',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'status' => (string) fake()->randomElement([0, 1, 1, 1]),
        ];
    }
}
