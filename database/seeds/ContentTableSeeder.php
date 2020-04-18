<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags_ids = [];
        for($i = 1; $i <= 5; $i++) {
            $tag = new \App\Models\Tag();
            $tag->fill([
                'title' => "Tag $i",
                'slug' => "tag-$i"
            ]);
            $tag->save();
            $tags_ids[] = $tag->id;
        }

        for($i = 1; $i < 16; $i++) {
            $post = new \App\Models\Post();
            $post->fill([
                'title' => "Test post content $i",
                'icon' => 'fa fa-code',
                'content' => 'Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. ',
                'excerpt' => 'Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. ',
                'is_published' => 1,
                'slug' => "test-post-content-$i"
            ]);
            $post->save();

            $post->tags()->sync([$tags_ids[rand(0 , 4)], $tags_ids[rand(0 , 4)]]);
        }

        for($i = 1; $i < 3; $i++) {
            $page = new \App\Models\Page();
            $page->fill([
                'title' => "Test Page $i",
                'content' => 'Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. ',
                'is_published' => 1,
                'slug' => "test-page-$i"
            ]);
            $page->save();
        }
    }
}
