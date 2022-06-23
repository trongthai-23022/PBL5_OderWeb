<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'parent_id','slug'];

    public function child_categories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function latestProducts(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->latest()->limit(10);
    }

}
