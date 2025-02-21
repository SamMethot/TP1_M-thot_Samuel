<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Language extends Model
{

    protected $fillable = ['name'];

    public function films()
    {
        return $this->hasMany(Film::class, 'language_id');
    }
}
