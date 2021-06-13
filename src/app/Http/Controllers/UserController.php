<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $service;

    public function __construct(\App\Services\UserService $userService)
    {
        $this->service = $userService;
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

    public function store(UserRequest $request)
    {
        try {

            $input = $request->all();

            $type = $this->service->save($input);

            return response()->json($type, 200);

        } catch (Exception $e) {

            return response()->json(['message' => $e->getMessage()], 400);

        }
    }

    public function update(UserRequest $request, Int $id)
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
