<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MarkModel extends Model
{
    use HasFactory;

    protected $table = 'marks';
    protected $primaryKey = 'mark_id';

    protected $fillable = [
        'mark_nome',
        'mark_slug',
    ];

    public function model()
    {
        return $this->hasOne(\App\Models\ModelModel::class, 'id_mode_yea');
    }
}
