<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gare extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'zone_id',
    ];

    // Relation avec la table 'zones'
    // Dans le modèle Gare
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

}
