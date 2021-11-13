<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelYearModel extends Model
{
    use HasFactory;

    protected $table = 'model_years';
    protected $primaryKey = 'mode_yea_id';

    protected $fillable = [
        'mode_yea_launch',
        'mode_yea_end_of_production',
    ];

    public function model()
    {
        return $this->hasOne(\App\Models\ModelModel::class, 'id_mode_yea');
    }
}
 