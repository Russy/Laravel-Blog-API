<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Languages;
use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function update(Request $request) {
        try {
            $data = $request->only(['title']);
            $category = Category::firstOrNew(['id' => $request->get('id')]);
            if (!$request->get('id')) {
                //TODO:Make slugs uniq
                $data['slug'] = Languages::cyrillicToLat($data['title']);
            }
            $category->fill($data);
            $category->save();

            return response()->json([
                'success' => true,
                'data' => $category,
                'errors' => []
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => true,
                'data' => [],
                'errors' => [$e->getMessage()]
            ]);
        }

    }

    public function get() {
        return Category::all();
    }

    public function delete($id) {
        Category::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'errors' => []
        ]);
    }

}
