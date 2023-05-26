<?php

namespace App\Models;
use Illuminate\Support\Str; // <- da importare
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',


    ];
    public static function generateSlug(string $name){
        return Str::slug($name, '-');

    }




    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
