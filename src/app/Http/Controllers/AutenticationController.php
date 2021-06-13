<?php

namespace App\Http\Controllers;

class AutenticationController extends Controller
{
    protected $service;

    public function __construct(\App\Services\AutenticationService $autenticationService)
    {
        $this->service = $autenticationService;
    }

    public function store(\App\Http\Requests\AutenticationRequest $request)
    {
        try {

            $input = $request->all();

            $type = $this->service->autenticar($input);

            return response()->json($type, 200);

        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }
}
