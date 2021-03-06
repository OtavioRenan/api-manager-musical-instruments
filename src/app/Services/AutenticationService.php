<?php
declare(strict_types=1);

namespace App\Services;

use Exception;
class AutenticationService
{
    public function __construct(\App\Repositorys\AutenticationRepository $autenticationRepository)
    {
        $this->repository = $autenticationRepository;
    }

    public function auth(array $input)
    {
        $user = $this->repository->getWhere(removeCaracterLogin($input['userLogin']));

        if (!$user)
        {
            throw new Exception('Usuário inválido.'); 
        }

        if (!password_verify($input['userPassword'], $user->password))
        {
            throw new Exception('Senha inválida.'); 
        }
        
        if (! $token = auth()->attempt($this->filterInput($input)))
        {
            throw new Exception('Autenticação não autorizada.'); 
        }
        
        return $this->createNewToken($token);
    }

    public function register(array $input)
    {
        $data = $this->filterInput($input, true);
        
        if($this->repository->register($data))
        {
            if(! $token = auth()->attempt($this->filterInput($input)))
            {
                throw new Exception('Autenticação não autorizada.');
            }
        }

        return $this->createNewToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }

    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile()
    {
        $user = auth()->user();

        if ($user)
        {
            return response()->json($this->filterOutput($user));
        } 

        return response()->json(['message' => 'Token não informado.'], 401);
    }

    protected function createNewToken($token) : Object
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => [
                'userName' => auth()->user()->name,
                'userLogin' => auth()->user()->login
            ]
        ]);
    }

    protected function filterInput(array $input, $register = null) : array
    {
        $data =  [];

        if(isset($input['userName']))
        {
            $data['name'] = $input['userName'];
        }
        
        if($register)
        {
            $data['password'] =  bcrypt($input['userPassword']);
        } else {
            $data['password'] =  $input['userPassword'];
        }

        $data['login'] = $input['userLogin'];

        return $data;
    }

    protected function filterOutput(\Illuminate\Database\Eloquent\Model $model) : array
    {
        return [
            'userName' => $model->name,
            'userLogin' => $model->login
        ];
    }
}
