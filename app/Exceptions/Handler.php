<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            // Log::error($e->getMessage(), ['exception' => $e]);
        });
    }

    public function render($request, Throwable $exception): RedirectResponse
    {
         Log::error($exception->getMessage(), ['exception' => $exception]);

        // Handle ValidationException separately
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            if ($request->expectsJson()) {
                return response()->json($exception->errors(), 422);
            }
    
            // For web requests, let Laravel handle it
            return parent::render($request, $exception);
        }
    
        // Default behavior for other exceptions
        if ($request->expectsJson()) {
            return response()->json(['error' => 'An unexpected error occurred. Please try again.'], 500);
        }
    
        // Redirect back with a generic error message for web requests
        return back()->with('error', 'An unexpected error occurred. Please try again.');
    }
}
