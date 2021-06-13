<?php
declare(strict_types=1);

namespace App\Services;

use Firebase\JWT\JWT;

class AutenticationService
{
    protected $repository;

    protected $key = '8xad012Amcd';

    protected $exp = 3600;

    protected $crip = 'HS256';

    public function __construct(\App\Repositorys\AutenticationRepository $autenticationRepository)
    {
        $this->repository = $autenticationRepository;
    }

    public function autenticar(array $input)
    {
        $user = $this->repository->getWhere(['user_login' => removeCaracterLogin($input['login'])]);

        if (!$user) {
            throw new \App\Http\Exceptions\AutenticationUserExistsException();
        }

        if (!password_verify($input['password'], $user->user_password)) {
            throw new \App\Http\Exceptions\AutenticationPasswordExistsException();
        }

        $datas = [
            'id' => $user->user_id,
            'name' => $user->user_name,
            'login' => $user->user_login,
        ];

        $time = time();
        $expire = $time + $this->exp;

        $tokenParams = [
            'iat' => $time,
            'nbf' => $time - 1,
            'data' => $datas,
            'exp' => $expire
        ];

        $token = JWT::encode($tokenParams, $this->key);

        return [
            'token' => $token,
            'name' => $user->user_name,
            'login' => $user->user_login,
            'expire' => $tokenParams['exp'] - $tokenParams['iat']
        ];
    }

    public function extractDatas(string $token)
    {
        return JWT::decode($token, $this->key, [$this->crip]);
    }
}
