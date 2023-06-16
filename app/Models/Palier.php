<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palier extends Model
{
    use HasFactory;

    public $timestamps = false;

    const RULE = [
    ];

    protected $guarded = ['id'];

    static function calculate_commision($vente)
    {
        $paliers = Palier::orderBy('total_min')->get();
        $commision = 0;
        foreach ($paliers as $palier)
        {
            if($vente <= 0)
                return $commision;
            $difference = (min($palier->total_max - $palier->total_min , $vente));
            $commision += ($difference*$palier->pourcentage)/100;
            $vente -= $difference;
        }
        return $commision;
    }

}
