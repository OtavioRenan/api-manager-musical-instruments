<?php
declare(strict_types=1);

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
