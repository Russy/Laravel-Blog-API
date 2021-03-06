<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Languages;
use App\Http\Controllers\ApiController;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends ApiController
{

    public function getPages() {

        $pages = Page::where('is_published', 1)
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $pages,
            'errors' => []
        ]);
    }

    public function getBySlug($slug) {

        $page = Page::where('slug', $slug)
            ->where('is_published', 1)
            ->first();

        if ($page) {
            return response()->json([
                'success' => true,
                'data' => $page,
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
