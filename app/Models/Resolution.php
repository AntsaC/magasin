<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    use HasFactory;

    public $timestamps = false;

    const RULE = [
    ];

    protected $guarded = ['id'];

}
