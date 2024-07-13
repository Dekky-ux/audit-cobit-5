<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemInformasi extends Model
{
    use HasFactory;
    public $guarded = ["id"];

    public function Kuesioner(){
        return $this->hasMany(Kuesioner::class);
    }
    public function User(){
        return $this->hasMany(User::class);
    }
}
