<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends ApiController
{
    public $successStatus = 200;

    public function create(Request $request) {
        $data = $request->only(['title', 'content']);

        dd($data);
    }

}
