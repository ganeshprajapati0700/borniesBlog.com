<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Laravel', 'PHP', 'JavaScript', 'React', 'Vue', 'Python',
            'AI', 'Machine Learning', 'SEO', 'Marketing', 'Productivity',
            'DevOps', 'Docker', 'AWS', 'Open Source', 'Design', 'UX',
            'Startup', 'Remote Work', 'Fitness', 'Nutrition', 'Investing',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'status' => (string) fake()->randomElement([0, 1, 1, 1]),
        ];
    }
}
