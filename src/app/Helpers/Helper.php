<?php
declare(strict_types=1);

use App\Repositorys\LogStoreRepository;
use Illuminate\Database\Eloquent\Model;

if(!function_exists('routeUnion'))
{
    function routeUnion(String $controller, String $meth = null) : String
    {
        if($meth)
        {
            return '\App\Http\Controllers' . $controller . 'Controller' . '@' . $meth;
        }

        return '\App\Http\Controllers' . $controller . 'Controller';
    }
}

if(!function_exists('removeCaracterLogin'))
{
    function removeCaracterLogin(String $input) : String
    {
        $input = trim($input);
        $input = str_replace(".", "", $input);
        $input = str_replace(",", "", $input);
        $input = str_replace("-", "", $input);
        $input = str_replace("/", "", $input);
        return $input;
    }
}


if(!function_exists('logStore'))
{
    function logStore(Model $model)
    {
        LogStoreRepository::saveOrUpdate($model);
    }
}

if(!function_exists('logDelete'))
{
    function logDelete(Model $model)
    {
        LogStoreRepository::delete($model);
    }
}