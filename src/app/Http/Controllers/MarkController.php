<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\MarkRequest;

class MarkController extends Controller
{
    protected $service;

    public function __construct(\App\Services\MarkService $markService)
    {
        $this->service = $markService;
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

    public function store(MarkRequest $request)
    {
        try {

            $input = $request->all();

            $mark = $this->service->save($input);

            return response()->json($mark, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function update(MarkRequest $request, Int $id)
    {
        try {

            $input = $request->all();

            $mark = $this->service->update($id, $input);

            return response()->json($mark, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function destroy(Int $id)
    {
        try {

            $this->service->delete($id);

            return response()->json('Registro excluído com sucesso.', 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }
}
