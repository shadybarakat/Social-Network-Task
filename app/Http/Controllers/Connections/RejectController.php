<?php

namespace App\Http\Controllers\Connections;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use Illuminate\Http\Request;

class RejectController extends Controller
{
    public function __invoke(Connection $connection)
    {
        $connection->update(['status' => 'rejected']);
        return response()->json(['success' => 'Request rejected!']);
    }
}
