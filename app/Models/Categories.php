<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(string[] $type)
 */
class Categories extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
    ];
}
