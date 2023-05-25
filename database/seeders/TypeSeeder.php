<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // <- da importare

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Frontend', 'Backend', 'Sicurezza informatica', 'Guida', 'Tutotial'];
        
       foreach($types as $type ) {
        $newType = new Type();
        $newType->name=$type;
        $newType->slug=  Str::slug($type, '-');
        $newType->save();
       }
    }
}
