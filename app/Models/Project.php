<?php

namespace App\Models;
use Illuminate\Support\Str; // <- da importare
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'slug',
        'type_id'

    ];


    public static function generateSlug(string $title){
        return Str::slug($title, '-');

    }

    public function type() {
        return $this->belongsTo(Type::class);
    }
    //unisce la tabella project
    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }

}
