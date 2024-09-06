<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    /**
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    public function response(array $data, int $status = 200): JsonResponse
    {
        return response()->json($data, $status);
    }
}
