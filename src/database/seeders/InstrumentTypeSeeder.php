<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstrumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        $types = [
            0 => ['inst_typ_name' => 'Percussão'],
            1 => ['inst_typ_name' => 'Sopro'],
            2 => ['inst_typ_name' => 'Corda'],
            3 => ['inst_typ_name' => 'Eletrônico']
        ];

        foreach($types as $type)
        {
            DB::table('instrument_types')->insert([
                'inst_typ_name' => $type['inst_typ_name'],
                'inst_typ_slug' => \Illuminate\Support\Str::slug($type['inst_typ_name'])
            ]);
        }
    }
}
