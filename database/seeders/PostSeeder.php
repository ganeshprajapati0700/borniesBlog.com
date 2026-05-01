<?php

namespace Database\Seeders;

use App\Models\AssignedTag;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('assigned_tags')->truncate();
        DB::table('posts')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $tagIds = Tag::pluck('id')->toArray();

        Post::factory(40)->create()->each(function (Post $post) use ($tagIds) {
            if (empty($tagIds)) {
                return;
            }

            // Assign 1–3 random tags per post
            $count = fake()->numberBetween(1, 3);
            $assigned = array_unique(
                array_map(fn () => $tagIds[array_rand($tagIds)], range(1, $count))
            );

            foreach ($assigned as $tagId) {
                AssignedTag::create([
                    'post_id' => $post->id,
                    'tag_id' => $tagId,
                ]);
            }
        });
    }
}
