<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function detailImages(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,
            'product_tags',
            'product_id',
            'tag_id')
            ->withTimestamps()->latest();;
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'product_id');
    }
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class, 'product_id');
    }
}
