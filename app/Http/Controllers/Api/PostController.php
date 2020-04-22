<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    public function getPosts()
    {
        $posts = Post::where('is_published', 1)
            ->with('tags')
            ->with('categories')
            ->orderBy('id', 'desc')
            ->paginate(5);
        return response()->json([
            'success' => true,
            'data' => $posts,
            'errors' => []
        ]);
    }

    public function getBySlug($slug)
    {
        $post = Post::where('slug', $slug)
            ->with('tags')
            ->with('categories')
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

    public function search(Request $request) {
        $query = $request->get('query');
        $posts = Post::where('title','LIKE', "%$query%")
            ->orWhere('content','LIKE', "%$query%")
            ->orWhere('excerpt','LIKE', "%$query%")
            ->where('is_published', 1)
            ->with('tags')
            ->with('categories')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'data' => $posts
            ],
            'errors' => []
        ]);
    }

    public function postsByTags($tag) {

        $posts = Post::where('is_published', 1)
          ->with('tags')
            ->whereHas( 'tags', function($query) use($tag) {
                $query->where('tags.slug', $tag);
            })
            ->whereHas('tags')
            ->with('categories')
            ->paginate(5);

        return response()->json([
            'success' => true,
            'data' => $posts,
            'errors' => []
        ]);
    }

}
