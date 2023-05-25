<?php

namespace Database\Seeders;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // <- da importare
use Faker\Generator as Faker;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i<10; $i++) {
            $newProject = new Project();
            $newProject->title = $faker->sentence(5);
            $newProject->description = $faker->text(500);
            $newProject->cover_image = $faker->url();
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->save();
        }
    }
}
