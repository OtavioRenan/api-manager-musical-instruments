<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\InstrumentRequest;

class InstrumentController extends Controller
{
    protected $service;

    public function __construct(\App\Services\InstrumentService $instrumentService)
    {
        $this->service = $instrumentService;
    }

    public function index()
    {
        try {

            $input = request()->all();

            $instrument = $this->service->all($input);

            return response()->json($instrument, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function show(Int $id)
    {
        try {

            $instrument = $this->service->find($id);

            return response()->json($instrument, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function store(InstrumentRequest $request)
    {
        try {

            $input = $request->all();

            $instrument = $this->service->save($input);

            return response()->json($instrument, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function update(InstrumentRequest $request, Int $id)
    {
        try {

            $input = $request->all();

            $instrument = $this->service->update($id, $input);

            return response()->json($instrument, 200);

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
