<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTokenRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTokenRequest $request)
    {
        [
            'email' => $email,
            'password' => $password,
            'device_name' => $device_name,
        ] = $request->safe()->all();

        $user = User::where('email', $email)->first();

        if (
            $user
            && Hash::check($password, $user->password)
        ) {
            return response(
                [
                    'status' => 'success',
                    'message' => 'Access Token generation succeed!',
                    'data' => [
                        'token' => $user->createToken($device_name)->plainTextToken,
                    ],
                ]
            );
        }

        return response(
            [
                'status' => 'error',
                'message' => 'Access Token generation failed!',
                'errors' => [
                    'Unable to create access token.',
                ],
            ],
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}