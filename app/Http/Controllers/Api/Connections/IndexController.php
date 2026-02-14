<?php

namespace App\Http\Controllers\Api\Connections;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ConnectionResource;

class IndexController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $connections = $user->connections()->get();

        return ApiResponse::success([
            'posts' => ConnectionResource::collection($connections),
        ]);
    }
}
