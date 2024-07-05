<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    protected function successResponse($data, $message = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null
        ], $code);
    }

    protected function notFoundResponse($message = 'Resource not found')
    {
        return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
    }

    protected function validationErrorResponse($errors)
    {
        return response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
