<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\ModelYearRequest;

class ModelYearController extends Controller
{
    protected $service;

    public function __construct(\App\Services\ModelYearService $modelYearService)
    {
        $this->service = $modelYearService;
    }

    public function index()
    {
        try {

            $input = request()->all();

            $model = $this->service->all($input);

            return response()->json($model, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function show(Int $id)
    {
        try {

            $model = $this->service->find($id);

            return response()->json($model, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function store(ModelYearRequest $request)
    {
        try {

            $input = $request->all();

            $model = $this->service->save($input);

            return response()->json($model, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function update(ModelYearRequest $request, Int $id)
    {
        try {

            $input = $request->all();

            $model = $this->service->update($id, $input);

            return response()->json($model, 200);

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
