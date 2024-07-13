<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    use HasFactory;
    public $guarded = ["id"];

    public function JawabanResponden(){
        return $this->hasMany(JawabanResponden::class);
    }
}
