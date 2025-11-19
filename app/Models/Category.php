<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get all products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
