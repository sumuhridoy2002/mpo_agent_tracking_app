<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class ApiExceptionHandler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            return $this->handleApiException($request, $exception);
        }

        return parent::render($request, $exception);
    }

    protected function handleApiException($request, Throwable $exception): JsonResponse
    {
        $status = 500;

        if ($this->isHttpException($exception)) {
            if ($exception instanceof HttpException) {
                $status = $exception->getStatusCode();
            }
        }

        return response()->json([
            'error' => [
                'message' => $exception->getMessage(),
                'status' => $status,
            ],
        ], $status);
    }

    // Other methods...

    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return parent::unauthenticated($request, $exception);
    }

    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return response()->json(['error' => $exception->getMessage()], $exception->status);
    }

    protected function convertHttpExceptionToResponse(HttpException $e): JsonResponse
    {
        return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
    }
}