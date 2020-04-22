<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Languages;
use App\Http\Controllers\ApiController;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    public function getPosts() {

        $posts = Post::orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $posts,
            'errors' => []
        ]);
    }

    public function getById($id) {

        $post = Post::where('id', $id)
            ->with('tags')
            ->with('categories')
            ->first();

        if ($post) {
            return response()->json([
                'success' => true,
                'data' => $post,
                'errors' => []
            ]);
        }
        return response()->json([
            'success' => false,
            'data' => [],
            'errors' => ['page is not found']
        ]);
    }
    public function update(Request $request) {

        $data = $request->only(['title', 'content', 'is_published', 'icon', 'excerpt']);
        $post = Post::firstOrNew(['id' => $request->get('id')]);

        if (!$request->get('id')) {
            //TODO:Make slugs uniq
            $data['slug'] = Languages::cyrillicToLat($data['title']);
        }

        $post->fill($data);
        $post->save();

        //Save tags
        if ($tags = $request->get('tags')) {
            $post->tags()->sync(array_map(function($tag) {
                return $tag['id'];
            }, $tags));
        }

        //Save categories
        if ($categories = $request->get('categories')) {
            $post->tags()->sync(array_map(function($category) {
                return $category['id'];
            }, $categories));
        }

        return response()->json([
            'success' => true,
            'data' => $post,
            'errors' => []
        ]);
    }

    public function delete($id) {
        Post::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'errors' => []
        ]);
    }

}
