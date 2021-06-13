<?php
declare(strict_types=1);

namespace App\Models;

class InstrumentModel extends \Illuminate\Database\Eloquent\Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'instrument';
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

    public function mode()
    {
        return $this->belongsTo(\App\Models\ModeModel::class, 'id_mode');
    }

    public function mark()
    {
        return $this->belongsTo(\App\Models\MarkModel::class, 'id_mark');
    }
}
