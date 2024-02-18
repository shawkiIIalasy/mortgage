<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait ApiResponder
{
    /**
     * Return a success JSON response.
     *
     * @param array|string $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function success(array|string $data, string $message = null, int $code = ResponseAlias::HTTP_OK): JsonResponse {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param string|null $message
     * @param int|string $code
     * @param null $errors
     * @return JsonResponse
     */
    protected function error(string $message = null, int|string $code, $errors = null): JsonResponse {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'errors' => $errors ?? [],
        ], $code);
    }

    /**
     * Return an OK JSON response.
     *
     * @return JsonResponse
     */
    protected function ok(): JsonResponse {
        return $this->success([], 'Success');
    }
}
