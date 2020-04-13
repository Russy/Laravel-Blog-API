<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Languages;
use App\Http\Controllers\ApiController;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function update(Request $request) {

        $data = $request->only(['title']);
        $category = Category::firstOrNew(['id' => $request->get('id')]);
        if (!$request->get('id')) {
            $data['slug'] = Languages::cyrillicToLat($data['title']);
        }
        $category->fill($data);
        $category->save();

        return response()->json([
            'success' => true,
            'data' => $category,
            'errors' => []
        ]);
    }

}
