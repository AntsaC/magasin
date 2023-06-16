<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Project extends Model
{
    use HasFactory;

    const RULE = [
    ];

    public $fillable = [
        "name",
        "category_id"
    ];

    public $timestamps = false;

    protected $with = [
        'category'
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public static function filter($object) {
        return Project::
        when($object->name, function (Builder $builder, string $name){
            $builder->where('name','ILIKE', '%'.$name.'%');
        })
            ->when($object->category, function (Builder $builder, int $name){
                $builder->where('category_id', $name);
            })
            ->when($object->min, function (Builder $builder, $name){
                $builder->where('deadline','>=', $name);
            })
            ->when($object->max, function (Builder $builder, $name){
                $builder->where('deadline','<=', $name);
            })
            ->get();
    }
}
