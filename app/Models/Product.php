<?php

namespace App\Models;

use App\Traits\CreateSlugTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CreateSlugTrait;
    protected $guarded = [];
    public function detailImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class,
            'product_tags',
            'product_id',
            'tag_id')
            ->withTimestamps()->latest();
    }
<<<<<<< HEAD
    public function category(): BelongsTo
=======
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
>>>>>>> d90344c57a3c99ef4220ffe5f8a613b153f1580b
    {
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

    public function slug(): string
    {
        return $this->create_slug($this->attributes['name']);
    }
}
