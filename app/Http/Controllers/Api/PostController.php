<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Languages;
use App\Http\Controllers\ApiController;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    public function getPosts() {

        $posts = Post::where('is_published', 1)
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
