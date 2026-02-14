<?php

namespace App\Http\Controllers\Api\Connections;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ConnectionResource;
use App\Models\Connection;

class RejectController extends Controller
{
    public function __invoke(Connection $connection)
    {
        $connection->update(['status' => 'rejected']);
        return ApiResponse::created(
            new ConnectionResource($connection),
            'Friend request rejected'
        );
    }
}
