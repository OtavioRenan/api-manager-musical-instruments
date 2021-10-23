<?php

namespace App\Traits;

use App\Models\LogModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait LogTrait
{
    /**
     * Handle model event
     */
    public static function boot()
    {
        /**
         * Data creating and updating event
         */
        parent::boot();
        static::saved(function ($model) {
            // create or update?
            if ($model->wasRecentlyCreated) {
                static::storeLog($model, static::class, 'CREATED');
            } else {
                if (!$model->getChanges()) {
                    return;
                }
                static::storeLog($model, static::class, 'UPDATED');
            }
        });

        /**
         * Data deleting event
         */
        static::deleted(function (Model $model) {
            static::storeLog($model, static::class, 'DELETED');
        });
    }

    /**
     * Retrieve the current login user id
     * @return int|string|null
     */
    public static function activeUserId()
    {
        return Auth::guard(static::activeUserGuard())->id() != null ? Auth::guard(static::activeUserGuard())->id() : 1;
    }

    /**
     * Retrieve the current login user guard name
     * @return mixed|null
     */
    public static function activeUserGuard()
    {
        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) {
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
    public static function storeLog($model, $modelPath, $action)
    {

        $newValues = null;
        $oldValues = null;
        if ($action === 'CREATED') {
            $newValues = $model->getAttributes();
        } elseif ($action === 'UPDATED') {
            $newValues = $model->getChanges();
        }

        if ($action !== 'CREATED') {
            $oldValues = $model->getOriginal();
        }
        
        $systemLog = new LogModel();
        $systemLog->system_logable_id = $model->getKey();
        $systemLog->system_logable_type = $modelPath;
        $systemLog->user_id = static::activeUserId();
        $systemLog->guard_name = static::activeUserGuard();
        $systemLog->action = $action;
        $systemLog->old_value = !empty($oldValues) ? json_encode($oldValues) : null;
        $systemLog->new_value = !empty($newValues) ? json_encode($newValues) : null;
        $systemLog->ip_address = request()->ip();
        $systemLog->save();
    }
}