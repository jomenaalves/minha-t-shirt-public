<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ModelNotFoundException extends Exception
{
    public function __construct($model, $code = 0, Exception $previous = null)
    {
        $message = "O Registro não foi encontrado.";
        parent::__construct($message, $code, $previous);
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => $this->getMessage()
        ], 404);
    }
}
