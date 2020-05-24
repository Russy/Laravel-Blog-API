<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiController;
use App\Models\Options;
use Illuminate\Http\Request;

class OptionsController extends ApiController
{
    public function list()
    {
        $options = Options::get(['id', 'name', 'value']);
        return response()->json([
            'success' => true,
            'data' => $options->toArray(),
            'errors' => []
        ]);
    }

    public function post(Request $request)
    {
        Options::getQuery()->delete();

        $options = $request->get('options');
        $response = [];

        foreach ($options as $opt) {
            $option = Options::firstOrCreate(['name' => $opt['name']]);
            $option->update(['name' => $opt['name'], 'value' => $opt['value']]);
            $option->save();
            $response[] = $option->toArray();
        }
        return response()->json([
            'success' => true,
            'data' => $response,
            'errors' => []
        ]);
    }


}
