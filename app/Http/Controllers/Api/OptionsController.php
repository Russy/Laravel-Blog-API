<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Options;
use Illuminate\Http\Request;

class OptionsController extends ApiController
{
    public function get($name)
    {
        $option = Options::where('name', $name)->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $option->toArray(),
            'errors' => []
        ]);
    }


}
