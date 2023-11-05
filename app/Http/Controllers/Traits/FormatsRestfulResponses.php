<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Response;

trait FormatsRestfulResponses
{
    protected $route_actions = [
        'index' => ['list', 'listing'],
        'show' => ['list', 'listing'],
        'store' => ['save', 'saving'],
        'update' => ['save', 'saving'],
        'destroy' => ['delete', 'deleting'],
    ];

    protected function composeMessage(
        $route = 'index',
        $success = true
    )
    {
        $action = $this->route_actions[$route][1] ?? 'unknown';

        return sprintf(
            '%s %s %s!',
            $this->response_object,
            $action,
            $success ? 'succeed' : 'failed'
        );
    }

    protected function composeErrors(
        string $route = 'index',
        array $data = []
    )
    {
        $error = match ( $route ) {
            'index' => 'No results found.',
            'show' => sprintf(
                'No %s found with the ID of %s.',
                strtolower($this->response_object),
                $data['id']
            ),
            'store', 'update' => sprintf(
                'Unable to save %s.',
                strtolower($this->response_object)
            ),
            'destroy' => sprintf(
                'Unable to delete %s.',
                strtolower($this->response_object)
            ),
            default => 'unknown',
        };

        return [$error];
    }

    public function successResponse(
        $route = 'index',
        $data = null
    )
    {
        return response(
            [
                'status' => 'success',
                'message' => $this->composeMessage(
                    $route,
                    true
                ),
                'data' => $data,
            ]
        );
    }

    public function failedResponse(
        string $route = 'index',
        array $data = [],
        array $additional_errors = [],
        int $status_code = Response::HTTP_BAD_REQUEST
    )
    {
        $errors = $this->composeErrors(
            $route,
            $data
        ) + $additional_errors;

        return response(
            [
                'status' => 'failed',
                'message' => $this->composeMessage(
                    $route,
                    false
                ),
                'errors' => $errors,
            ],
            $status_code
        );
    }
}