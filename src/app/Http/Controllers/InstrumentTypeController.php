<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\InstrumentTypeRequest;

class InstrumentTypeController extends Controller
{
    protected $service;

    public function __construct(\App\Services\InstrumentTypeService $instrumentTypeService)
    {
        $this->service = $instrumentTypeService;
    }

    public function index()
    {
        try {

            $input = request()->all();

            $types = $this->service->all($input);

            return response()->json($types, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function show(Int $id)
    {
        try {

            $type = $this->service->find($id);

            return response()->json($type, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function store(InstrumentTypeRequest $request)
    {
        try {

            $input = $request->all();

            $type = $this->service->save($input);

            return response()->json($type, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function update(InstrumentTypeRequest $request, Int $id)
    {
        try {

            $input = $request->all();

            $type = $this->service->update($id, $input);

            return response()->json($type, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function destroy(Int $id)
    {
        try {

            $type = $this->service->delete($id);

            return response()->json('Registro excluído com sucesso.', 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }
}
