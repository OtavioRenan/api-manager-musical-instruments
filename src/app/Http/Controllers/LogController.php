<?php

namespace App\Http\Controllers;

use Exception;

class LogController extends Controller
{
    protected $service;

    public function __construct(\App\Services\LogService $logService)
    {
        $this->service = $logService;
    }

    public function index()
    {
        try {

            $input = request()->all();

            $marks = $this->service->all($input);

            return response()->json($marks, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function show(Int $id)
    {
        try {

            $mark = $this->service->find($id);

            return response()->json($mark, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }
}
