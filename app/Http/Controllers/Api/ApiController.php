<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * Api response on success
     *
     * @param mixed $message
     * @param int $code
     *
     * @return JsonResponse
     */
    public function successResponse($message = '', int $code = 200): JsonResponse
    {
        return $this->apiResponse(true, $message, $code);
    }

    /**
     * Api response on failed
     *
     * @param mixed $message
     * @param int $code
     *
     * @return JsonResponse
     */
    public function failedResponse($message, int $code = 422): JsonResponse
    {
        return $this->apiResponse(false, $message, $code);
    }

    /**
     * Api response
     *
     * @param bool $success
     * @param mixed $message
     * @param int $code
     *
     * @return JsonResponse
     */
    private function apiResponse(bool $success, $message, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'data' => $message,
        ], $code);
    }
}
