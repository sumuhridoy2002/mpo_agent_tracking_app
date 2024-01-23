<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

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
        // Check if the request is for API routes
        if ($request->is('api/*')) {
            // Use the ApiExceptionHandler for API routes
            return (new ApiExceptionHandler($this->container))->render($request, $exception);
        }

        return parent::render($request, $exception);
    }
}