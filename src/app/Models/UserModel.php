<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'login',
        'password'
    ];
}