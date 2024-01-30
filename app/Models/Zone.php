<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
    ];

    // Relation avec la table 'gares'
    public function gares()
    {
        return $this->hasMany(Gare::class);
    }
}
