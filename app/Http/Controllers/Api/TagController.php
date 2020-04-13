<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Languages;
use App\Http\Controllers\ApiController;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends ApiController
{
    public function update(Request $request) {

        $data = $request->only(['title']);
        $tag = Tag::firstOrNew(['id' => $request->get('id')]);

        if (!$request->get('id')) {
            $data['slug'] = Languages::cyrillicToLat($data['title']);
        }

        $tag->fill($data);
        $tag->save();

        return response()->json([
            'success' => true,
            'data' => $tag,
            'errors' => []
        ]);
    }

}
