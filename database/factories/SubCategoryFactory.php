<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(fake()->numberBetween(1, 3), true);

        return [
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'status' => (string) fake()->randomElement([0, 1, 1, 1]),
        ];
    }
}
