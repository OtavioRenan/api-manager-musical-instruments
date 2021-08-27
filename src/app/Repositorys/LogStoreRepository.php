<?php
declare(strict_types=1);

namespace App\Repositorys;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\LogModel;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogStoreRepository
{
    /**
     * Handle model event
     */
    public static function saveOrUpdate(Model $model)
    {
        if ($model->wasRecentlyCreated)
        {
            self::storeLog($model, 'CREATED');
        } else {
            if (!$model->getChanges())
            {
                return;
            }
            self::storeLog($model, 'UPDATED');
        }
    }

    public static function delete(Model $model)
    {
        self::storeLog($model, 'DELETED');
    }

    /**
     * Generate the model name
     * @param  Model  $model
     * @return string
     */
    public static function getTagName(Model $model)
    {
        return !empty($model->tagName) ? $model->tagName : Str::title(Str::snake(class_basename($model), ' '));
    }

    /**
     * Retrieve the current login user id
     * @return int|string|null
     */
    public static function activeUserId()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        
        return $user->id;
    }

    /**
     * Retrieve the current login user guard name
     * @return mixed|null
     */
    public static function activeUserGuard()
    {
        foreach (array_keys(config('auth.guards')) as $guard)
        {

            if (auth()->guard($guard)->check())
            {
                return $guard;
            }
        }
        return null;
    }

    /**
     * Store model logs
     * @param $model
     * @param $modelPath
     * @param $action
     */
    public static function storeLog($model, $action)
    {
        $newValues = null;
        $oldValues = null;
        if ($action === 'CREATED')
        {
            $newValues = $model->getAttributes();
        } elseif ($action === 'UPDATED') {
            $newValues = $model->getChanges();
        }

        if ($action !== 'CREATED') {
            $oldValues = $model->getOriginal();
        }

        $systemLog = new LogModel();
        $systemLog->system_logable_id = $model[$model->getKeyName()];
        $systemLog->system_logable_type = self::getTagName($model);
        $systemLog->user_id = static::activeUserId();
        $systemLog->guard_name = static::activeUserGuard();
        $systemLog->action = $action;
        $systemLog->old_value = !empty($oldValues) ? json_encode($oldValues) : null;
        $systemLog->new_value = !empty($newValues) ? json_encode($newValues) : null;
        $systemLog->ip_address = request()->ip();
        $systemLog->save();
    }
}