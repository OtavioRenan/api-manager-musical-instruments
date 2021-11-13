<?php

namespace App\Http\Controllers;

class AutenticationController extends Controller
{
    protected $service;

    public function __construct(\App\Services\AutenticationService $autenticationService)
    {
        $this->service = $autenticationService;
    }

    public function auth(\App\Http\Requests\AutenticationRequest $request)
    {
        try {
            
            $input = $request->all();

            $user = $this->service->auth($input);

            return response()->json($user, 200);

        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function store(\App\Http\Requests\UserRequest $request)
    {
        try {

            $input = $request->all();

            $user = $this->service->register($input);

            return response()->json($user, 200);

        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function refresh(\App\Http\Requests\AutenticationRequest $request)
    {
        try {

            $input = $request->all();

            $user = $this->service->refresh($input);

            return response()->json($user, 200);

        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function logout(\App\Http\Requests\AutenticationRequest $request)
    {
        try {

            return $this->service->logout();

        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function userProfile()
    {
        try {            

            return $this->service->userProfile();

        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }
}
