<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\LogTrait;

class InstrumentTypeModel extends Model
{
    use HasFactory, LogTrait;

    protected $table = 'instrument_types';
    protected $primaryKey = 'inst_typ_id';

    protected $fillable = [
        'inst_typ_name',
        'inst_typ_slug',
    ];
}
