<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Post;

class PostController extends ApiController
{
    public function getPosts() {

        $posts = Post::where('is_published', 1)
            ->with('tags')
            ->with('categories')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $posts,
            'errors' => []
        ]);
    }

    public function getBySlug($slug) {

        $post = Post::where('slug', $slug)
            ->where('is_published', 1)
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

}
