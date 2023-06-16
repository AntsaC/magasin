<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lost extends Model
{
    use HasFactory;

    public $timestamps = false;

    const RULE = [
    ];

    protected $guarded = ['id'];

    protected $primaryKey = 'laptop_id';

}
