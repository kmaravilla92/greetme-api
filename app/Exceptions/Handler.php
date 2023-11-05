<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function render($request, $e)
    {
        if (
            $request->expectsJson()
            && $e instanceof ModelNotFoundException
        ) {
            return response([
                'status' => 'error',
                'message' => 'Model not found!',
                'errors' => [
                    $e->getMessage(),
                ],
            ]);
        }

        return parent::render($request, $e);
    }
}
