<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstrumentTypeModel extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'instrument_type';
    protected $primaryKey = 'inst_typ_id';

    protected $fillable = [
        'inst_typ_name',
        'inst_typ_slug',
    ];
}
