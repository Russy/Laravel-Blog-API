<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Languages;
use App\Http\Controllers\ApiController;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends ApiController
{

    public function getPages() {

        $pages = Page::paginate(10);

        return response()->json([
            'success' => true,
            'data' => $pages,
            'errors' => []
        ]);
    }

    public function getById($id) {

        $page = Page::where('id', $id)
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

    public function update(Request $request) {

        $data = $request->only(['title', 'content', 'is_published']);
        $page = Page::firstOrNew(['id' => $request->get('id')]);
        if (!$request->get('id')) {
            //TODO:Make slugs uniq
            $data['slug'] = Languages::cyrillicToLat($data['title']);
        }
        $page->fill($data);
        $page->save();

        return response()->json([
            'success' => true,
            'data' => $page,
            'errors' => []
        ]);
    }

    public function delete($id) {
        Page::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'errors' => []
        ]);
    }

}
