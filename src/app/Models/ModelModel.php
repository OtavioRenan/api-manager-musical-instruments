<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelModel extends Model
{
    use HasFactory;

    protected $table = 'model';
    protected $primaryKey = 'mode_id';

    protected $fillable = [
        'mode_name',
        'mode_slug',
        'id_mode_yea'
    ];

    public function year()
    {
        return $this->belongsTo(\App\Models\ModelYearModel::class, 'id_mode_yea');
    }
}
