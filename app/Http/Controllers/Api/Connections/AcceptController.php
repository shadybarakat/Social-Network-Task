<?php

namespace App\Http\Controllers\Api\Connections;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ConnectionResource;
use App\Models\Connection;

class AcceptController extends Controller
{
    public function __invoke(Connection $connection)
    {
        $connection->update(['status' => 'accepted']);

        return ApiResponse::created(
            new ConnectionResource($connection),
            'Friend request accepted'
        );
    }
}
