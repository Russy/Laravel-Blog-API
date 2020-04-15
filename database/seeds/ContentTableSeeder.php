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
        for($i = 1; $i < 16; $i++) {
            $post = new \App\Models\Post();
            $post->fill([
                'title' => "Test post content $i",
                'icon' => '<span class="fa fa-code" aria-hidden="true"></span>',
                'content' => 'Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. ',
                'excerpt' => 'Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. ',
                'is_published' => 1,
                'slug' => "test-post-content-$i"
            ]);
            $post->save();
        }

        for($i = 1; $i < 3; $i++) {
            $post = new \App\Models\Post();
            $post->fill([
                'title' => "Test Page $i",
                'content' => 'Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. Lorem ipsum dollar sith. ',
                'is_published' => 1,
                'slug' => "test-page-$i"
            ]);
            $post->save();
        }
    }
}
