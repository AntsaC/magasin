<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefice extends Model
{
    use HasFactory;

    protected $table = 'v_benefice';

    static function find_all($year)
    {
        $benefices = $year != null ? Benefice::
            where('year', $year)
            ->orWhereNull('year')
            ->get() : Benefice::whereNotNull('year')->orderBy('year')->orderBy('month') ->get();

        $benefices->map(function ($item) {
           $item['commission'] = Palier::calculate_commision($item['total_vente']);
           $item['benefice'] = $item['benefice_final'] - $item['commission'];
        });

        return $benefices;
    }
}
