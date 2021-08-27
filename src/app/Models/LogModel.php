<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    protected $table = 'logs';

    protected $primaryKey = 'logs_id';

    protected $fillables = [
        'system_logable_id',
        'system_logable_type',
        'user_id',
        'guard_name',
        'action',
        'old_value',
        'new_value',
        'ip_address'
    ];
}