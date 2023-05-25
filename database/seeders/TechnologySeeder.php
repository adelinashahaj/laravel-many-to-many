<?php

namespace Database\Seeders;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // <- da importare
class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologys = ['Php', 'js', 'mysql', 'css', 'html'];
        
        foreach($technologys as $technology ) {
            $newTechnologys = new Technology();
            $newTechnologys->name=$technology;
            $newTechnologys->slug=  Str::slug($technology, '-');
            $newTechnologys->save();
           }
    }
}
