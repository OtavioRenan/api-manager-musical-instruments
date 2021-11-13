<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentModel extends Model
{
    use HasFactory;

    protected $table = 'instruments';
    protected $primaryKey = 'inst_id';

    protected $fillable = [
        'inst_name',
        'inst_slug',
        'inst_description',
        'id_inst_typ',
        'id_mode',
        'id_mark'
    ]; 

    public function type()
    {
        return $this->belongsTo(\App\Models\InstrumentTypeModel::class, 'id_inst_typ');
    }

    public function model()
    {
        return $this->belongsTo(\App\Models\ModelModel::class, 'id_mode');
    }

    public function mark()
    {
        return $this->belongsTo(\App\Models\MarkModel::class, 'id_mark');
    }
}
